<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Essential Studio for JavaScript : Detail Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-base/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-buttons/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-calendars/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-dropdowns/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-inputs/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-splitbuttons/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-lists/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-popups/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-navigations/styles/material.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.syncfusion.com/ej2/20.4.38/ej2-schedule/styles/material.css" rel="stylesheet" type="text/css"/>
		<script src="https://cdn.syncfusion.com/ej2/20.4.38/dist/ej2.min.js" type="text/javascript"></script>
</head>
<body>    
<?php
  // initialize scheduler
  echo '
  <div id="Schedule"></div>
  <script>
  var dataManager = new ej.data.DataManager({
	url: "http://localhost/ej2-php-crud-service/server.php",
	crudUrl: "http://localhost/ej2-php-crud-service/server.php",
	adaptor: new ej.data.UrlAdaptor(),
	crossDomain: true
});
    var scheduleObj = new ej.schedule.Schedule({
		height: "550px",
        selectedDate: new Date(2020, 9, 20),
        views: ["TimelineDay", "TimelineWeek"],
        allowDragAndDrop: true,
        eventSettings: { dataSource: dataManager },
        group: {
            resources: ["MeetingRoom"]
        },
        resources: [{
                field: "RoomID", title: "Room Type",
                name: "MeetingRoom", allowMultiple: true,
                dataSource: [
                    { text: "Jammy", id: 1, color: "#ea7a57", capacity: 20, type: "Conference" },
                    { text: "Tweety", id: 2, color: "#7fa900", capacity: 7, type: "Cabin" },
                    { text: "Nestle", id: 3, color: "#5978ee", capacity: 5, type: "Cabin" },
                    { text: "Phoenix", id: 4, color: "#fec200", capacity: 15, type: "Conference" },
                    { text: "Mission", id: 5, color: "#df5286", capacity: 25, type: "Conference" },
                    { text: "Hangout", id: 6, color: "#00bdae", capacity: 10, type: "Cabin" },
                    { text: "Rick Roll", id: 7, color: "#865fcf", capacity: 20, type: "Conference" },
                    { text: "Rainbow", id: 8, color: "#1aaa55", capacity: 8, type: "Cabin" },
                    { text: "Swarm", id: 9, color: "#df5286", capacity: 30, type: "Conference" },
                    { text: "Photogenic", id: 10, color: "#710193", capacity: 25, type: "Conference" }
                ],
                textField: "text", idField: "id", colorField: "color"
            }],
    });
    scheduleObj.appendTo("#Schedule");
  </script>
  ';
?>
</body>
</html>