// register.lslp 
// 2022-05-23 16:22:05 - LSLForge (0.1.9.6) generated
/*********************************************
*  Copyright (c) 2022 Paul Preibisch
*
* register.lsl
*  Copyright:
*  Paul G. Preibisch (Fire Centaur in SL)
*  fire@b3dMultiTech.com  
* 
*/
string body = "";
key httpRegister;
string server = "";
string endpoint = "user/registerSlAvatar";
string myName;
string myKey;
integer MENU_CHANNEL;
key gSetupQueryId;
string gSetupNotecardName = "config";
integer gSetupNotecardLine;
/***********************************************
*  readSettingsNotecard()
*  |-->used to read notecard settings
***********************************************/
readSettingsNotecard(){
  (gSetupNotecardLine = 0);
  (gSetupQueryId = llGetNotecardLine(gSetupNotecardName,gSetupNotecardLine));
}

/***********************************************
*  random_integer()
*  |-->Produces a random integer
***********************************************/ 
integer random_integer(integer min,integer max){
  return (min + ((integer)llFrand(((max - min) + 1))));
}
string paramsToString(list params){
  integer index = 0;
  string paramStr = "?";
  list records = llList2ListStrided(params,0,(-1),2);
  integer length = llGetListLength(records);
  while ((index < length)) {
    string param = llList2String(records,index);
    string value = llList2String(records,(index + 1));
    (paramStr += (((param + "=") + value) + "&"));
    (index++);
  }
  return paramStr;
}
default {

    changed(integer change) {
    if ((change == CHANGED_INVENTORY)) {
      llResetScript();
    }
  }

     on_rez(integer start_param) {
    llResetScript();
  }

    
    state_entry() {
    llSay(0,"Initializing");
    (myName = llGetObjectName());
    (myKey = llGetKey());
    (MENU_CHANNEL = random_integer(2000,3000));
    state readSettings;
  }
}

state readSettings {

    changed(integer change) {
    if ((change == CHANGED_INVENTORY)) {
      llResetScript();
    }
  }

      on_rez(integer start_param) {
    llResetScript();
  }

    state_entry() {
    llSay(0,"Reading Config");
    readSettingsNotecard();
  }

   dataserver(key queryId,string data) {
    if ((queryId == gSetupQueryId)) {
      if ((data != EOF)) {
        if ((llGetSubString(data,0,1) == "//")) {
          (gSetupQueryId = llGetNotecardLine(gSetupNotecardName,(++gSetupNotecardLine)));
        }
        list tmp = llParseString2List(data,["|"],[]);
        string field = llList2String(tmp,0);
        if ((field == "server")) (server = llToLower(llList2String(tmp,1)));
        (gSetupQueryId = llGetNotecardLine(gSetupNotecardName,(++gSetupNotecardLine)));
      }
      else  state loaded;
    }
  }
}
state loaded {

    changed(integer change) {
    if ((change == CHANGED_INVENTORY)) {
      llResetScript();
    }
  }

    on_rez(integer start_param) {
    llResetScript();
  }

    state_entry() {
    llSay(0,("Ready - API is: " + server));
    state ready;
  }
}
state ready {

    changed(integer change) {
    if ((change == CHANGED_INVENTORY)) {
      llResetScript();
    }
  }

    on_rez(integer start_param) {
    llResetScript();
  }

    state_entry() {
    list paramList = ["name","fire","email","fire@b3dmultitech.com"];
    string paramsToSend = paramsToString(paramList);
    string url = ((server + endpoint) + paramsToSend);
    llSay(0,("Contacting server " + url));
    (httpRegister = llHTTPRequest(url,[HTTP_METHOD,"GET",HTTP_MIMETYPE,"application/x-www-form-urlencoded"],body));
  }

    http_response(key request_id,integer status,list metadata,string body) {
    llSay(0,body);
  }
}
// register.lslp 
// 2022-05-23 16:22:05 - LSLForge (0.1.9.6) generated
