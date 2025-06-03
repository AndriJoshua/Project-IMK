import pywhatkit
import time
number = "+6285356277535"

for i in range(0,10):
    pywhatkit.sendwhatmsg_instantly(number,"oi zd ini pesan dari koding akan dikirim tiap 5 detik selama 10 kali")
    time.sleep(5)
    
