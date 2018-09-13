# import json

# temp = {}
# temp['data'] = []
# temp['data'].append({
#     'x': '0',
#     'y': '0',
# })

# with open('tempdat.json', 'w') as outfile:
#     json.dump(temp, outfile)

import json
from time import localtime, gmtime, strftime
temp=[]

temp.append({
    'x': strftime("%Y-%m-%d %H:%M:%S", localtime()),
    'y': '0',
})

with open('droplet/tempdat.json', 'w') as outfile:
    json.dump(temp, outfile)
with open('droplet/humdat.json', 'w') as outfile:
    json.dump(temp, outfile)
with open('droplet/waterdat.json', 'w') as outfile:
    json.dump(temp, outfile)
