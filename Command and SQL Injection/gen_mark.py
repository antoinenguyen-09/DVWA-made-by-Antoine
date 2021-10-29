import mysql.connector
import sys

studentID = sys.argv[1]
classID = sys.argv[2]

mydb = mysql.connector.connect(host="localhost",user="kali",password="kali",database="class")
mycursor = mydb.cursor()
mycursor.execute("SELECT mark FROM "+classID+" WHERE id="+studentID)
myresult = mycursor.fetchall()

for x in myresult:
  print(x[0])
