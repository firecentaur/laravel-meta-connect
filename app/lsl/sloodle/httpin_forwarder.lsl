// sloodle.httpin_forwarder.lslp 
// 2022-05-23 14:10:12 - LSLForge (0.1.9.6) generated
/*********************************************
*  Copyrght (c) 2009 Paul Preibisch
*  Released under the GNU GPL 3.0
*  This script can be used in your scripts, but you must include this copyright header as per the GPL Licence
*  For more information about GPL 3.0 - see: http://www.gnu.org/copyleft/gpl.html
*  This script is part of the SLOODLE Project see http://sloodle.org
*
*  httpIn_forwarder.lsl
*  Copyright:
*  Paul G. Preibisch (Fire Centaur in SL)
*  fire@b3dMultiTech.com  
*
*  Edmund Edgar (Edmund Earp in SL) 
*  ed@socialminds
*

*/

string sloodleserverroot = "";
string sloodlepwd = "";
integer isconfigured = FALSE;
integer eof = FALSE;
integer sloodlecontrollerid = 0;
integer sloodlemoduleid = 0;
integer sloodlelistentoobjects = 0;
integer sloodleobjectaccessleveluse = 0;
integer sloodleobjectaccesslevelctrl = 0;
integer sloodleserveraccesslevel = 0;
integer sloodleautodeactivate = 1;
integer SLOODLE_CHANNEL_OBJECT_CREATOR_REQUEST_CONFIGURATION_VIA_HTTP_IN_URL = -1639270089;
string SLOODLE_HTTP_IN_REQUEST_LINKER = "/mod/sloodle/classroom/httpin_config_linker.php/";
integer SLOODLE_CHANNEL_OBJECT_DIALOG = -3857343;
// Link message channels
integer SLOODLE_CHANNEL_TRANSLATION_REQUEST = -1928374651;

// Translation output methods
string SLOODLE_TRANSLATE_SAY = "say";
key httpchat;
// Configure by receiving a linked message from another script in the object
// Returns TRUE if the object has all the data it needs
integer sloodle_handle_command(string str){
  list bits = llParseString2List(str,["|"],[]);
  integer numbits = llGetListLength(bits);
  string name = llList2String(bits,0);
  string value1 = "";
  string value2 = "";
  string SLOODLE_EOF = "sloodleeof";
  if ((numbits > 1)) (value1 = llList2String(bits,1));
  if ((numbits > 2)) (value2 = llList2String(bits,2));
  llSay(0,str);
  if ((name == "set:sloodleserverroot")) (sloodleserverroot = value1);
  else  if ((name == "set:sloodlepwd")) {
    if ((value2 != "")) (sloodlepwd = ((value1 + "|") + value2));
    else  (sloodlepwd = value1);
  }
  else  if ((name == "set:sloodlecontrollerid")) (sloodlecontrollerid = ((integer)value1));
  else  if ((name == "set:sloodlelistentoobjects")) (sloodlelistentoobjects = ((integer)value1));
  else  if ((name == "set:sloodleobjectaccessleveluse")) (sloodleobjectaccessleveluse = ((integer)value1));
  else  if ((name == "set:sloodleobjectaccesslevelctrl")) (sloodleobjectaccesslevelctrl = ((integer)value1));
  else  if ((name == "set:sloodleserveraccesslevel")) (sloodleserveraccesslevel = ((integer)value1));
  else  if ((name == "set:sloodleautodeactivate")) (sloodleautodeactivate = ((integer)value1));
  else  if ((name == SLOODLE_EOF)) (eof = TRUE);
  return (((sloodleserverroot != "") && (sloodlepwd != "")) && (sloodlecontrollerid > 0));
}

// Send a translation request link message
sloodle_translation_request(string output_method,list output_params,string string_name,list string_params,key keyval,string batch){
  llMessageLinked(LINK_THIS,SLOODLE_CHANNEL_TRANSLATION_REQUEST,((((((((output_method + "|") + llList2CSV(output_params)) + "|") + string_name) + "|") + llList2CSV(string_params)) + "|") + batch),keyval);
}
default {

    state_entry() {
    llOwnerSay("Httpin_forwarder waiting for ready state");
  }

     link_message(integer sender_num,integer num,string str,key id) {
    if ((num == SLOODLE_CHANNEL_OBJECT_DIALOG)) {
      list lines = llParseString2List(str,["\n"],[]);
      integer numlines = llGetListLength(lines);
      integer i = 0;
      for ((i = 0); (i < numlines); (i++)) {
        (isconfigured = sloodle_handle_command(llList2String(lines,i)));
        llSay(0,((string)isconfigured));
      }
      if ((eof == TRUE)) {
        if ((isconfigured == TRUE)) {
          sloodle_translation_request(SLOODLE_TRANSLATE_SAY,[0],"configurationreceived",[],NULL_KEY,"");
          state ready;
        }
        else  {
          sloodle_translation_request(SLOODLE_TRANSLATE_SAY,[0],"configdatamissing",[],NULL_KEY,"");
          llMessageLinked(LINK_THIS,SLOODLE_CHANNEL_OBJECT_DIALOG,"do:reconfigure",NULL_KEY);
          (eof = FALSE);
        }
      }
    }
  }
}

state ready {


    
     state_entry() {
    llOwnerSay("Httpin_forwarder ready");
    llListen(SLOODLE_CHANNEL_OBJECT_CREATOR_REQUEST_CONFIGURATION_VIA_HTTP_IN_URL,"",NULL_KEY,"");
  }

        
    listen(integer channel,string name,key id,string str) {
    if ((channel != SLOODLE_CHANNEL_OBJECT_CREATOR_REQUEST_CONFIGURATION_VIA_HTTP_IN_URL)) return;
    if ((!(llGetOwnerKey(id) == llGetOwner()))) return;
    string body = ("sloodlecontrollerid=" + ((string)sloodlecontrollerid));
    (body += ("&sloodlepwd=" + sloodlepwd));
    (body += ("&sloodlemoduleid=" + ((string)sloodlemoduleid)));
    (body += ("&sloodleobjuuid=" + ((string)llGetKey())));
    (body += ("&childobjectuuid=" + ((string)id)));
    (body += ("&httpinurl=" + str));
    (httpchat = llHTTPRequest((sloodleserverroot + SLOODLE_HTTP_IN_REQUEST_LINKER),[HTTP_METHOD,"POST",HTTP_MIMETYPE,"application/x-www-form-urlencoded"],body));
  }

    http_response(key request_id,integer status,list metadata,string body) {
    list lines = llParseStringKeepNulls(body,["\n"],[]);
    integer numlines = llGetListLength(lines);
    list statusfields = llParseStringKeepNulls(llList2String(lines,0),["|"],[]);
    integer statuscode = llList2Integer(statusfields,0);
    if ((statuscode < 0)) {
      key objKey = llList2Key(lines,1);
      if ((statuscode == (-217))) {
        llOwnerSay(("Could not save HTTP In URL for rezzed object " + llKey2Name(objKey)));
      }
      else  if ((statuscode == (-218))) {
        llOwnerSay(("child object not found " + llKey2Name(objKey)));
      }
      else  if ((statuscode == (-219))) {
        llOwnerSay(("Sending configuration to object via HTTP-in URL failed " + llKey2Name(objKey)));
      }
      else  {
        llOwnerSay(((("Unknown Error: " + ((string)statuscode)) + " ") + llKey2Name(objKey)));
      }
    }
  }
}
// sloodle.httpin_forwarder.lslp 
// 2022-05-23 14:10:12 - LSLForge (0.1.9.6) generated
