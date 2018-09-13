import json
import time
from time import gmtime, strftime, localtime
cot=0
smT=0
smH=0
smW=0
time.sleep(2)
while True:
	cot
	smT
	smH
	smW
	cot=(cot+1)%10
	t=open("droplet/temp.php","r")
	far = t.read()
	t.close()
	far=float(far)
	# print far
	smT=smT+far
	y=open("droplet/humid.php","r")
	hum = y.read()
	hum = float(hum)
	y.close()
	smH=smH+hum
	u=open("droplet/water_temp.php","r")
	wfar = u.read()
	wfar = float(wfar)
	u.close()
	smW=smW+wfar
	print far
	print hum
	print wfar
	if cot%10==0:
		with open('droplet/tempdat.json', 'r') as f:
		     temp = json.load(f)
		# idx=int(temp[-1]['x'])
		temp.append({
		    'x': strftime("%Y-%m-%d %H:%M:%S", localtime()),
		    'y': smT/10
		})
		print smT/10
		while len(temp) > 144 :
			temp.pop(0)
		with open('droplet/tempdat.json', 'w+') as outfile:
		    json.dump(temp, outfile)
		smT=0

		with open('droplet/waterdat.json', 'r') as f:
		     water = json.load(f)
		# idx=int(water[-1]['x'])
		water.append({
		    'x': strftime("%Y-%m-%d %H:%M:%S", localtime()),
		    'y': smW/10
		})
		print smW/10
		while len(water) > 144 :
			water.pop(0)

		with open('droplet/waterdat.json', 'w+') as outfile:
		    json.dump(water, outfile)
		smW=0

		with open('droplet/humdat.json', 'r') as f:
		     hum = json.load(f)
		# idx=int(hum[-1]['x'])
		hum.append({
		    'x': strftime("%Y-%m-%d %H:%M:%S", localtime()),
		    'y': smH/10
		})
		print smH/10
		while len(hum) > 144 :
			hum.pop(0)
		with open('droplet/humdat.json', 'w+') as outfile:
		    json.dump(hum, outfile)
		smH=0
	time.sleep(60)