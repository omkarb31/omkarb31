import smtplib, ssl  
import sys
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart


receiver=sys.argv[1]
token=sys.argv[2]
print(receiver)
print(token)
sender= "omkarbasargi@gmail.com"     #senders email id
password="jqvyowoxysirqmtf"                #password

port = 465
#text='Password Reset link form Remotelab'
    

message = MIMEMultipart("alternative")
message["Subject"] = "Reset Password"
message["From"] = sender
message["To"] = receiver


# Create the plain-text and HTML version of your message
text = "Password Reset link form Remotelab"
html = """\
<html>
  <body>
     we got a request form you to reset Password! 
     <br>Click the link bellow: 
    <br><a href='http://localhost/login/updatePassword.php?email="""+receiver+"""&reset_token="""+token+"""'>reset password</a>
  </body>
</html>
"""

# Turn these into plain/html MIMEText objects
part1 = MIMEText(text, "plain")
part2 = MIMEText(html, "html")

# Add HTML/plain-text parts to MIMEMultipart message
# The email client will try to render the last part first
message.attach(part1)
message.attach(part2)
context = ssl.create_default_context()

print("Starting to send")
try:
	with smtplib.SMTP_SSL("smtp.gmail.com", port, context=context) as server:
		server.login(sender, password)
		server.sendmail(sender, receiver, message.as_string())
	print(0)
except Exception as e:
    print(1)
