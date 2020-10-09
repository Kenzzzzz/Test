function dailyEventMessage() {
  var googleCalendarID = "9u33kds0b2m37l5m859k94gqec@group.calendar.google.com";
  
  var calendar = CalendarApp.getCalendarById(googleCalendarID);
  var Today = new Date();
  var dailyEventList = calendar.getEventsForDay(Today);
  var message = "";
 
  
  for (var i = 0; i < dailyEventList.length; i++){
    
    var eventTitle = "Title : " + dailyEventList[i].getTitle();
    var eventTime = "Start Time : " + dailyEventList[i].getStartTime().toTimeString().slice(0,8);
    var eventDescribtion = "Description : " + "\n" + dailyEventList[i].getDescription();
    
    message += "\n" + eventTitle + "\n" + eventTime + "\n" + eventDescribtion;
  
  }

  if (message !== "") {
    return;

  }  
    Logger.log(message); 
    sendMessage(message);
    
 

} 


function sendMessage(message) {
  var lineNotifyEndPoint = "https://notify-api.line.me/api/notify";
  var accessToken = "vmrtwsZdinQxw8CJLEQ4UMnxRIsc7NLYWYqEookGSNM";
  
  var formData = {
    "message": message
  };
  
  var options = {
    "headers" : {"Authorization" : "Bearer " + accessToken},
    "method" : "post",
    "payload" : formData
  };

  try {
    var response = UrlFetchApp.fetch(lineNotifyEndPoint, options);
  }
  catch (error) {
    Logger.log(error.name + "：" + error.message);
    return;
  }
    
  if (response.getResponseCode() !== 200) {
    Logger.log("Sending message failed.");
  } 
}
