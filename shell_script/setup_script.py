#!/usr/bin/python

import subprocess

subprocess.call(["apt-get", "update"])

subprocess.check_call(["apt-get", "install", "-y", "vim"])

subprocess.check_call(["apt-get", "install", "-y", "python-software-properties"])

subprocess.check_call(["apt-get", "install", "-y", "curl"])

subprocess.check_call(["apt-get", "install", "-y", "git"])

subprocess.check_call(["apt-get", "install", "-y", "nginx"])

subprocess.check_call(["apt-get", "install", "-y", "php5-fpm"])
subprocess.check_call(["apt-get", "install", "-y", "php5-cli"])
subprocess.check_call(["apt-get", "install", "-y", "php5-mysql"])
subprocess.check_call(["apt-get", "install", "-y", "php5-curl"])
subprocess.check_call(["apt-get", "install", "-y", "php5-gd"])
subprocess.check_call(["apt-get", "install", "-y", "php5-mcrypt"])

subprocess.check_call(["apt-get", "install", "-y", "mysql-server"])







