## REST API Inspection System (Restis)
#### Inspect and monitor your REST APIs locally & build testing scenarios
This Node.JS-based script is designed to inspect & monitor REST APIs with local mashine and has following features:
* Check and test your REST APIs behavior with built-in Request Master ~~and save them for later~~;
* Send plain HTTP requests in few clicks;
* ~~Write automated testing scenarios with simple scripting language;~~
* ~~Schedule automatic inspections and receive notifications with results;~~
* ~~Build complex test scenarios and immediately run them;~~
* ~~Share results with your team and generate reports with build-in report generator.~~

#### How to run
* Download and copy to local path contents of "master";
* Run Restis with Node.JS:
```
node node-server.js
```
* Web server of Restis is now available at 
```
http://localhost:8020/
```

#### How to use
As for now, with Restis you can send requests to REST API using POST, GET, PUT, DELETE methods with managable parameters and optional Basic Authentication and custom headers features. These options are available directly from home page at `http://localhost:8020/`.

#### Planned
- [ ] Dashboard with such blocks as "Last testings", "Average response time", "Statistics" etc.
- [ ] Multiuser interface
- [ ] Team sharing
- [ ] Report generator
- [ ] Notifications
- [ ] API monitoring (how to make it done?..)
