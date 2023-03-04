# Thanks to bguerville for the toolset and Jamesiswack for providing the toolset dump: https://github.com/JamesIsWack/bgtoolset-mirror

# bgtoolset-mirror
Mirror of BG-TOOLSET, may softbrick some consoles. Use at your own risk.

# How to access without selfhost
go to [this link](http://bgtoolset.altervista.org) to access the toolset. 

## [Advanced / Simple] Hosting With `Docker` 
(Linux specific example shown below, but should be very similar for other operating systems)

1. Go to your home directory:

```
cd ~/
```

2. Clone this repository:

```
git clone https://github.com/xcibe95x/bgtoolset
```

3. Deploy the server using `trafex/php-nginx` image, and volume mounting this repo to the webserver:

```
docker run -itd --rm -p 80:8080 -v ~/bgtoolset/:/var/www/html:Z trafex/php-nginx
```

4. Plug your PS3 into your LAN where your computer, hosting via Docker, is also connected.

5. Assuming your computer's firewall allows port 80 outbound, you will be able to reach the bgtoolset exploit site by navigating to:

```
PS3 > Browser > [ PRESS START ] > http://<your_computer_ip>/
```
