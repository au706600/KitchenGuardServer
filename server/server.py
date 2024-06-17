

# Sources of original code from this file:
# https://www.emqx.com/en/blog/how-to-use-mqtt-in-python
# https://pynative.com/python-mysql-database-connection/
# We have also reused the HEUCOD class code that was supplied in tutorial 9

import mysql.connector # Connect to database 
from paho.mqtt import client as mqtt_client # mqtt library
import time
import json
from heucod import HeucodEvent # For supporting heucod events
from datetime import datetime, timezone 

def connect_mqtt() -> mqtt_client: # Function for connecting to broker
    def on_connect(client, userdata, flags, rc): # Calling this function after connecting to client
        # Check if client is connected successfully to broker
        if rc == 0:
            print("Connected to broker")
        else:   
            print("Failed to connect", rc)

    broker = "raspberrypi.local" # the mqtt broker
    port = 1883 # network port
    client_id = f"ti"
    client = mqtt_client.Client(client_id)
    client.username_pw_set("pi", "raspberry") #Authentication with username and password for mqtt broker 
    client.on_connect = on_connect  
    client.connect(broker, port) # Connect the client to broker

    return client

# For receiving the events from the PIR sensors, we can use the publisher/subscriber model, where the communication
# flows in one direction, namely publish events and then receive it and store in database. 
def publishTest(client, topic: str): # Function to publish messages/events 
    msg_count = 0
    while True:
        time.sleep(5) #wait for connection to establish

        event = HeucodEvent() 

        event.event_type = "KG.TestTypeEvent"
        event.sensor_location = "Kitchen"
        event.timestamp = datetime.now(tz=timezone.utc)

        result = client.publish(topic, event.to_json()) #In order to publish events to mqtt, the format has to be in json.

        status = result[0] 
        if status == 0:
            print(f"Sent event to topic `{topic}`") 
        else:
            print(f"Failed to send message to topic {topic}")


def subscribeToEvents(client: mqtt_client, topic: str): # Function to receive the published events and store it in database
    def on_message(client, userdata, msg): # Calling this function after receiving the events. 
        payloadJsonString = msg.payload.decode() 

        print(f"Received `{msg}` from `{msg.topic}` topic")
        try:
            # connect() function to connect with the database, which here takes four arguments. 
            connection = mysql.connector.connect(host = "localhost",
                                                 database = "KitchenGuardData",
                                                 username = "root",
                                                 password = "grp4")

            event = HeucodEvent.from_json(payloadJsonString)
            
            # Insert and store the HEUCOD events into the database that have the columns eventType, eventLocation and the timestamp. 
            mysql_insert_query = (f"INSERT INTO eventData(eventType, eventLocation, timestamp) VALUES ( '{event.event_type}', '{event.sensor_location}', '{event.timestamp}')")

            # cursor() method for creating a cursor object for allowing to perform operations on database with python. 
            # connection is from above. 
            cursor = connection.cursor()
            cursor.execute(mysql_insert_query) # Performs the query from prior 
            connection.commit() # After performing the insert operation, the database will have the events stored into the columns. 

            print(cursor.rowcount, "Inserted successfully into the tables")
            
            cursor.close()

        except mysql.connector.Error as error: # Catch exceptions when failed to connect to database
            print("Failed to insert record {}".format(error)) 

        finally:
            if connection.is_connected():
                connection.close() 
                print("MySql connection is closed")

    client.subscribe(topic) # subscribe the topic published
    client.on_message = on_message # When a message or event has been received, this function will be called. 

    
def run(): 
    client = connect_mqtt()
    subscribeToEvents(client, "zigbee2mqtt/events")
    client.loop_forever()


if __name__ == '__main__':
    run()