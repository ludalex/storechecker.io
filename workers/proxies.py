from datetime import datetime
import sqlite3
from requests import session, __version__
from requests.exceptions import ConnectionError, ProxyError, Timeout
from bs4 import BeautifulSoup
import re

conn = sqlite3.connect('/var/www/n4checker/db/storechecker.db')
db = conn.cursor()

db.execute("delete from proxies")
conn.commit()

with session() as c:

	for page in range(1, 12):
		hma = c.get("http://hidemyass.com/proxy-list/"+str(page))
		soup =  BeautifulSoup(hma.text)
		hma_proxies = []

		trs = soup.findAll("tr")
		trs.pop(0)
		for tr in trs:
			tds = tr.findAll("td")

			ips = tds[1]
			port = tds[2].renderContents()
			proxyCountry = tds[3].find("span").text.strip()

			proxySpeed_style =  tds[4].find("div").find("div")['style']
			proxySpeed = re.findall('width\:(.*?)\%;', proxySpeed_style )[0].strip()


			proxyConnectionTime_style =  tds[5].find("div").find("div")['style']
			proxyConnectionTime = re.findall('width\:(.*?)\%;', proxyConnectionTime_style )[0].strip()


			proxyType = tds[6].renderContents()


			classesToStrip = []
			style = ips.find("style")
			for styleLine in style.renderContents().split('\n'):
				if styleLine:
					if "display:none" in styleLine or "display: none" in styleLine:
						classesToStrip.append( re.findall('.(.*?){', styleLine) )

			[s.extract() for s in ips.select( '[style~="display:none"]' )]
			
			for classToStrip in classesToStrip:
				[s.extract() for s in ips.select( '[class~="' + classToStrip[0] + '"]' )]

			[s.extract() for s in ips.select( 'style' )]


			ip_raw = ips.text  #ip_raw = nltk.clean_html(ips.renderContents())  
			if proxyType is not 'socks4/5':
			#hma_proxies.append({'ip': str(ip_raw.replace(" ", "")), 'port': port.replace("\n", ""), 'type': proxyType, 'country': str(proxyCountry), 'speed': proxySpeed, 'connectionTime': proxyConnectionTime})
				ip = str(ip_raw.replace(" ", ""))
				port = port.replace("\n", "")
				type = proxyType
				country = str(proxyCountry)
				speed = proxySpeed
				connectionTime = proxyConnectionTime
				dateTime = datetime.now()

				db.execute("INSERT INTO proxies VALUES (?,?,?,?,?,?,?,'hma','','')", (ip, port, type, country, speed, connectionTime, dateTime) )
				print ip + " added"

		conn.commit()
	#return hma_proxies
