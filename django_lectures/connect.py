#!/usr/bin/python
import psycopg2
import time
# Debut du decompte du temps
start_time = time.time()
conn = psycopg2.connect(
    database = "darese",
    user="inra_admin",
    password="au0luh",
    host="vmi-prod-114.jouy.inra.fr",
    port="54374"
)
print("conneted to postgreAdmin")

cur = conn.cursor()
cur.execute("select * from actu")
rows = cur.fetchall()
for row in rows:
    print("id :",row[0])
    #print("matricul : ",row[1])
    #print("date : ",row[2])
    #print("message : ",row[3])

print("BD queries completed")
conn.close()
print("Temps d execution : %s secondes ---" % (time.time() - start_time))
