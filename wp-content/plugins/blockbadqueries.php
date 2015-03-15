<?php
                  /*
                  Plugin Name: Block Bad Queries - Ultimate Security Checker
                  Plugin URI: http://perishablepress.com/press/2009/12/22/protect-wordpress-against-malicious-url-requests/
                  Description: Protect WordPress Against Malicious URL Requests -- Ultimate Security Checker -- Drop in PLugin
                  Author URI: http://perishablepress.com/
                  Author: Perishable Press
                  Version: 1.0
                  */
                  if (strpos($_SERVER['REQUEST_URI'], "eval(") ||
                    strpos($_SERVER['REQUEST_URI'], "CONCAT") ||
                    strpos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
                    strpos($_SERVER['REQUEST_URI'], "base64")) 
                    {
                      @header("HTTP/1.1 400 Bad Request");
                      @header("Status: 400 Bad Request");
                      @header("Connection: Close");
                      @exit;
                    }
                  ?>