// gameBuzzer.fire_buzzer.lslp 
// 2022-05-23 14:10:09 - LSLForge (0.1.9.6) generated
/*********************************************
*  Copyright (c) 2009 Paul Preibisch
*
* buzzer.lsl
*  Copyright:
*  Paul G. Preibisch (Fire Centaur in SL)
*  fire@b3dMultiTech.com  
* 
* This buzzer will start colored red. 
*  When teacher is ready, they click the ball, it turns green indicating it is ready to be clicked, count down timer displays
*  first three people to click get their name on the xy text 
* When clicked it makes clicking sound
* first click makes buzzer sound
*  teacher clicks on one of the names, and can assign points, or click (lose) to get a sound effect
*  Points go to the person instructure saved points for to the configured activity
* Play win sound
*
* Sound License
* Kodak Printer sound: http://www.freesound.org/samplesViewSingle.php?id=48667
* http://creativecommons.org/licenses/sampling+/1.0/
* nice.wav visit: http://www.freesound.org/samplesViewSingle.php?id=51488
* beepbeep.wav beep: http://www.freesound.org/samplesViewSingle.php?id=32683
*/
key gSetupQueryId;
string gSetupNotecardName = "config";
integer gSetupNotecardLine;
integer SETTEXT_CHANNEL = -8882;
integer SET_COLOR_CHANNEL = -889;
integer TIME_S = 0;
integer TIME_M = 1;
integer TIME_H = 0;
integer keyPressCount;
integer MAX_TIME;
string editNum = "";
integer SETTIMER = FALSE;
string SHOWARM = "HIDE";

list winners;
list winnerKeys;
list sitters;
list booths;
string myName;
key myKey;
list facilitators;
integer UI_CHANNEL = 89997;
integer ROW_CHANNEL;
// *************************************************** HOVER TEXT COLORS
vector RED = <0.77278,4.391e-2,0.0>;
vector GREEN = <0.12616,0.77712,0.0>;
integer MENU_CHANNEL;
integer XY_1 = -999821;
integer XY_2 = -999822;
integer XY_3 = -999823;
integer XY_TIMER = -999824;
integer counter;
list modifyPointList;
list primNames;
string setTime;
clear(){
  llMessageLinked(LINK_SET,XY_1,"                              ",NULL_KEY);
  llMessageLinked(LINK_SET,XY_2,"                              ",NULL_KEY);
  llMessageLinked(LINK_SET,XY_3,"                              ",NULL_KEY);
}
center(string s,integer len,integer channel){
  integer marginLen = (((integer)(len - llStringLength(((string)s)))) / 2);
  integer j;
  string spaces = "";
  for ((j = 0); (j < ((len * 10) + 1)); (++j)) {
    (spaces += " ");
  }
  string margin = llGetSubString(spaces,0,marginLen);
  string text = ((margin + ((string)s)) + margin);
  llMessageLinked(LINK_SET,channel,text,NULL_KEY);
}

//returns the link number of the prim named pName
integer getLink(string pName){
  return llListFindList(primNames,[pName]);
}
preloadSounds(){
  key buzzer = "9412be1e-2e35-101d-fd69-5c3459b3432f";
  llPreloadSound(buzzer);
  key tick = "23e88537-1817-df86-bb83-1e7d683ae493";
  llPreloadSound(tick);
  key beepbeep = "fb9cab14-e8cd-04f2-e3fe-b776820ad2f1";
  llPreloadSound(beepbeep);
  key onetype = "04d901bf-883d-e9f6-cb07-5c0f1b1f9d14";
  llPreloadSound(onetype);
  key ipress = "c3b49393-6283-df99-c97b-f0b616fc6979";
  llPreloadSound(ipress);
  key pd = "632d911f-10d1-2d30-c563-cdc29c3a7b56";
  llPreloadSound(pd);
  key iopen = "cf218344-0251-6bfd-acba-fdd5534861b1";
  llPreloadSound(iopen);
}
/***********************************************
*  readSettingsNotecard()
*  |-->used to read notecard settings
***********************************************/
readSettingsNotecard(){
  (gSetupNotecardLine = 0);
  (gSetupQueryId = llGetNotecardLine(gSetupNotecardName,gSetupNotecardLine));
}
/***********************************************
*  isFacilitator()
*  |-->is this person's name in the access notecard
***********************************************/
integer isFacilitator(string avName){
  if ((llListFindList(facilitators,[llToLower(avName)]) == (-1))) return FALSE;
  else  return TRUE;
}
/***********************************************
*  getMaxTime(integer seconds,integer minutes,integer hours)
*  |-->gets thenumber of seconds and returns a formated list 00:00:00
***********************************************/
string getTime(integer seconds){
  integer hours = ((integer)(seconds / 3600));
  integer minutes = ((integer)((seconds / 60) - (hours * 60)));
  integer s = ((integer)(seconds % 60));
  if ((s == 60)) {
    (minutes += 1);
    (s = 0);
  }
  if ((minutes == 60)) {
    (hours += 1);
    (minutes = 0);
  }
  string sString;
  string mString;
  string hString;
  if ((llStringLength(((string)s)) == 1)) {
    (sString = ("0" + ((string)s)));
  }
  else  (sString = ((string)s));
  if ((llStringLength(((string)minutes)) == 1)) {
    (mString = ("0" + ((string)minutes)));
  }
  else  (mString = ((string)minutes));
  if ((llStringLength(((string)hours)) == 1)) {
    (hString = ("0" + ((string)hours)));
  }
  else  (hString = ((string)hours));
  return ((((hString + ":") + mString) + ":") + sString);
}
/***********************************************
*  random_integer()
*  |-->Produces a random integer
***********************************************/ 
integer random_integer(integer min,integer max){
  return (min + ((integer)llFrand(((max - min) + 1))));
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
    llTriggerSound("5992af3b-fde1-309f-4077-2c8d5cb7153c",1.0);
    (MAX_TIME = ((TIME_S + (TIME_M * 60)) + (TIME_H * 3600)));
    integer numPrims = llGetNumberOfPrims();
    integer j;
    for ((j = 0); (j <= numPrims); (j++)) {
      (primNames += llGetLinkName(j));
    }
    llMessageLinked(LINK_SET,1,"p0",NULL_KEY);
    (myName = llGetObjectName());
    (myKey = llGetKey());
    (MENU_CHANNEL = random_integer(2000,3000));
    (ROW_CHANNEL = random_integer(2483000,3483000));
    state readAccessList;
  }
}
//read from notecard who can control
state readAccessList {

      on_rez(integer start_param) {
    llResetScript();
  }

    state_entry() {
    (facilitators += llToLower(llKey2Name(llGetOwner())));
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
        if ((field == "facilitator")) (facilitators += llToLower(llList2String(tmp,1)));
        (gSetupQueryId = llGetNotecardLine(gSetupNotecardName,(++gSetupNotecardLine)));
      }
      else  state ready;
    }
  }
}
         
state makeReady {

      on_rez(integer start_param) {
    llResetScript();
  }

    state_entry() {
    llOwnerSay("Preloading Sounds... please wait");
    preloadSounds();
    (SHOWARM = "HIDE");
    state ready;
  }
}
//waiting for teacher to touch it
state ready {

    on_rez(integer start_param) {
    llResetScript();
  }

    state_entry() {
    llTriggerSound("ea0fb023-c741-916b-e5aa-d02ef9995aba",1.0);
    llOwnerSay("Ready! Click the green cylindar to engage the buzzer!\nPress the red cylindar to disengage the buzzer, and the yellow cylindar to hide it!");
    integer j = 0;
    integer len = llGetListLength(booths);
    (sitters = []);
    llSetTimerEvent(0);
    llMessageLinked(LINK_SET,1,"p1",NULL_KEY);
    (winners = []);
    (winnerKeys = []);
    (modifyPointList = [0,0,0]);
    llTriggerSound("cf218344-0251-6bfd-acba-fdd5534861b1",1.0);
    center("00:00:00",10,XY_TIMER);
    llMessageLinked(LINK_SET,SETTEXT_CHANNEL,(("DISPLAY::top display|STRING::Ready:|COLOR::" + ((string)RED)) + "|ALPHA::1.0"),NULL_KEY);
    clear();
    llMessageLinked(LINK_SET,SET_COLOR_CHANNEL,"COMMAND:SET COLOR|PRIM:buzzer_button|COLOR:RED",NULL_KEY);
  }



    
    
    touch_start(integer num_detected) {
    string butName = llGetLinkName(llDetectedLinkNumber(0));
    if (isFacilitator(llDetectedName(0))) {
      llMessageLinked(LINK_SET,UI_CHANNEL,("COMMAND:BLINK|PRIM:" + butName),NULL_KEY);
      if ((butName == "hide_arm_button")) {
        llMessageLinked(LINK_SET,1,"p0",NULL_KEY);
        llTriggerSound("cf218344-0251-6bfd-acba-fdd5534861b1",1.0);
        return;
      }
      else  if ((butName == "dock_arm")) {
        llSetLinkPrimitiveParams(getLink("buzzer_button"),[PRIM_COLOR,ALL_SIDES,RED,1.0,PRIM_TEXTURE,0,"blank",<1.0,1.0,0.0>,<0.0,0.0,0.0>,0.0]);
        llTriggerSound("632d911f-10d1-2d30-c563-cdc29c3a7b56",1.0);
        llMessageLinked(LINK_SET,1,"p1",NULL_KEY);
        (SHOWARM = "HIDE");
        return;
      }
      else  if ((butName == "show_arm")) {
        (SHOWARM = "SHOW");
        llMessageLinked(LINK_SET,UI_CHANNEL,"COMMAND:BLINK|PRIM:timer",NULL_KEY);
        llTriggerSound("29cc964b-69ea-cdb2-e73a-3744d7aa83fb",1.0);
        llSetLinkPrimitiveParams(getLink("buzzer_button"),[PRIM_COLOR,ALL_SIDES,GREEN,1.0,PRIM_TEXTURE,0,"click",<1.0,1.0,0.0>,<0.0,0.0,0.0>,0.0]);
        llMessageLinked(LINK_SET,1,"p2",NULL_KEY);
        llTriggerSound("cf218344-0251-6bfd-acba-fdd5534861b1",1.0);
        (winners = []);
        return;
      }
      else  if ((butName == "hide_arm_button")) {
        (SHOWARM = "HIDE");
        state makeReady;
      }
      else  if ((butName == "stopwatch_button")) {
        llTriggerSound("14657220-fdd8-8d45-292d-a21950c05e23",1.0);
        llSetTimerEvent(0);
        (SETTIMER = FALSE);
        return;
      }
      else  if ((butName == "resetwatch_button")) {
        llTriggerSound("14657220-fdd8-8d45-292d-a21950c05e23",1.0);
        llSetTimerEvent(0);
        (counter = 0);
        (MAX_TIME = ((TIME_S + (TIME_M * 60)) + (TIME_H * 3600)));
        (SETTIMER = FALSE);
        integer timeLeft = (MAX_TIME - counter);
        string printTime = getTime(timeLeft);
        center(printTime,10,XY_TIMER);
        return;
      }
      else  if ((butName == "startwatch_button")) {
        if ((SETTIMER == TRUE)) {
          (TIME_S = ((integer)llGetSubString(editNum,6,7)));
          (TIME_M = ((integer)llGetSubString(editNum,3,4)));
          (TIME_H = ((integer)llGetSubString(editNum,0,1)));
          (SETTIMER == FALSE);
        }
        (MAX_TIME = ((TIME_S + (TIME_M * 60)) + (TIME_H * 3600)));
        llTriggerSound("14657220-fdd8-8d45-292d-a21950c05e23",1.0);
        llSetTimerEvent(1);
        return;
      }
      else  if ((butName == "set_timer")) {
        llTriggerSound("c3b49393-6283-df99-c97b-f0b616fc6979",1.0);
        llSetTimerEvent(0);
        (keyPressCount = 0);
        if ((SETTIMER == TRUE)) {
          llTriggerSound("dcebaa0e-d4d1-4e66-dc94-d453b7c78eb6",1.0);
          (TIME_S = ((integer)llGetSubString(editNum,6,7)));
          (TIME_M = ((integer)llGetSubString(editNum,3,4)));
          (TIME_H = ((integer)llGetSubString(editNum,0,1)));
          (MAX_TIME = ((TIME_S + (TIME_M * 60)) + (TIME_H * 3600)));
          (SETTIMER = FALSE);
          integer timeLeft = (MAX_TIME - counter);
          string printTime = getTime(timeLeft);
          center(printTime,10,XY_TIMER);
        }
        else  {
          (editNum = "00:00:00");
          (SETTIMER = TRUE);
        }
        return;
      }
      else  if ((butName == "backspace")) {
        if ((SETTIMER == TRUE)) {
          if ((llStringLength(editNum) == 1)) (editNum = "");
          else  (editNum = llGetSubString(editNum,0,(llStringLength(editNum) - 2)));
          llTriggerSound("04d901bf-883d-e9f6-cb07-5c0f1b1f9d14",1.0);
          center(editNum,10,XY_TIMER);
        }
        return;
      }
      else  if ((llListFindList(["b1","b2","b3","b4","b5","b6","b7","b8","b9","b0"],[butName]) != (-1))) {
        if ((SETTIMER == TRUE)) {
          (counter = 0);
          (keyPressCount++);
          string printTime = "";
          string num = llGetSubString(butName,1,1);
          if ((keyPressCount == 1)) (editNum = (llGetSubString(editNum,0,6) + num));
          else  if ((keyPressCount == 2)) (editNum = ((llGetSubString(editNum,0,5) + llGetSubString(editNum,7,7)) + num));
          else  if ((keyPressCount == 3)) (editNum = ((((llGetSubString(editNum,0,3) + llGetSubString(editNum,6,6)) + ":") + llGetSubString(editNum,7,7)) + num));
          else  if ((keyPressCount == 4)) (editNum = (((((llGetSubString(editNum,0,2) + llGetSubString(editNum,4,4)) + llGetSubString(editNum,6,6)) + ":") + llGetSubString(editNum,7,7)) + num));
          else  if ((keyPressCount == 5)) (editNum = ((((((("0" + llGetSubString(editNum,3,3)) + ":") + llGetSubString(editNum,4,4)) + llGetSubString(editNum,6,6)) + ":") + llGetSubString(editNum,7,7)) + num));
          else  if ((keyPressCount == 6)) (editNum = (((((((llGetSubString(editNum,1,1) + llGetSubString(editNum,3,3)) + ":") + llGetSubString(editNum,4,4)) + llGetSubString(editNum,6,6)) + ":") + llGetSubString(editNum,7,7)) + num));
          (setTime = editNum);
          center(editNum,10,XY_TIMER);
          llTriggerSound("04d901bf-883d-e9f6-cb07-5c0f1b1f9d14",1.0);
        }
        return;
      }
    }
    else  if ((butName != "buzzer_button")) llSay(0,("Sorry, you need to be a facilitator to use this function.  Facilitators are: " + ((string)llList2CSV(facilitators))));
    if ((butName == "buzzer_button")) {
      integer printChannel;
      string userName = llDetectedName(0);
      key userKey = llDetectedKey(0);
      if ((SHOWARM == "SHOW")) {
        llMessageLinked(LINK_SET,UI_CHANNEL,("COMMAND:BLINK|PRIM:" + butName),NULL_KEY);
        if ((llListFindList(winners,[userName]) == (-1))) {
          (winners += userName);
          (winnerKeys += userKey);
          integer numWinners = llGetListLength(winners);
          string anim = "p3";
          if ((numWinners < 4)) {
            llTriggerSound("3664dabd-5d57-d124-8929-e1fafdbdc55c",1.0);
            if ((numWinners == 1)) {
              (printChannel = XY_1);
              (anim = "p3");
            }
            else  if ((numWinners == 2)) {
              (printChannel = XY_2);
              (anim = "p4");
            }
            else  if ((numWinners == 3)) {
              (printChannel = XY_3);
              (anim = "p5");
            }
            llMessageLinked(LINK_SET,printChannel,userName,NULL_KEY);
            llMessageLinked(LINK_SET,1,anim,NULL_KEY);
            return;
          }
        }
      }
    }
  }

    timer() {
    integer timeLeft = (MAX_TIME - counter);
    string printTime = getTime(timeLeft);
    center(printTime,10,XY_TIMER);
    (++counter);
    if ((timeLeft < 5)) {
      llTriggerSound("fb9cab14-e8cd-04f2-e3fe-b776820ad2f1",1.0);
    }
    else  llTriggerSound("23e88537-1817-df86-bb83-1e7d683ae493",1.0);
    if ((counter > MAX_TIME)) {
      llSetTimerEvent(0.0);
      llMessageLinked(LINK_SET,1,"bp0",NULL_KEY);
      (counter = 0);
      center("00:00:00",10,XY_TIMER);
      llTriggerSound("9412be1e-2e35-101d-fd69-5c3459b3432f",1.0);
    }
  }

          changed(integer change) {
    if ((change == CHANGED_INVENTORY)) {
      llResetScript();
    }
  }
}
// gameBuzzer.fire_buzzer.lslp 
// 2022-05-23 14:10:09 - LSLForge (0.1.9.6) generated
