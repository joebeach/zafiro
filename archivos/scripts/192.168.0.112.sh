
				#!/bin/bash
				statname="192.168.0.112"
				uptime=`uptime | awk '{print $3}'`" dias, "`uptime | awk '{print $5}'`" horas"
				statin=`/sbin/iptables -L -v -x -n| grep "192.168.0.112_i"| grep 0.0.0.0 | awk '{print $2}'`
				statout=`/sbin/iptables -L -v -x -n| grep "192.168.0.112_o "| grep 0.0.0.0 | awk '{print $2}'`
				echo $statin
				echo $statout
				echo $uptime
				echo $statname
				