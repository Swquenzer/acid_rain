1. Project Requirements Specification
1.1 - Introduction

AcidRain is a project that intends to improve the efficiency and convenience of the Chemical Safety Sheet process by placing all Chemical Safety Sheets (CSS) along with their connections to the corresponding Material Safety Data Sheets (MSDS) on a dynamic database whose interface is accessible to all authorized personnel, allowing for a more effective way of storing data. This database and its interface will also give authorized users that ability to control and modify the database as the needs arises. The database interface is designed for use by our local EMU Science Department as well as the Harrisonburg Fire Department in case of emergency.
1.2 - Environment

The following Users, or Actors, will be present in the AcidRain environment:

    Developers: These will be the AcidRain team, namely Isaac Tice, Stephan Quenzer, and Josiah Driver. Their role will be to plan, create, analyze, implement, install, modify, verify, document, deploy, and maintain the software in its environment. They will also interact with selected, intended users to discover and clarify user requirements and specifications.
    Modifiers: These will be EMU students or faculty who are given access to the database interface will the ability to not only view data but insert new data as well as correct, edit, and delete existing data.
    Viewers: These will be those who for any reason wish to view the data, for example, the Harrisonburg Fire Chief, but are not given authority to modify it.

Acid Rain will have the following constraints: It must be user-friendly, it must be efficient and functional, and it must be secure. It will assume the EMU Science department will take care to only authorize the correct personnel and take care of the software piece responsibly. It will depend on the EMU server system and, as it will use primarily PHP, JavaScript, HTML5, MySQL, and such, it will also depend on an Apache Server to be functional.
Acid Rain will place its binary and other code files on Github and use the Github revision control system to organize and store our source code.
 
A link to our repository can be found here: https://github.com/Swquenzer/acid_rain

1.3 - Framework

    Languages: Acid Rain will be developed using php, javascript, MySQL and html5.
        Temporary Code: pieces of code that are only intended to be used on a temporary basis should have a comment starting with ** imediately before it, for multiline pieces of code immediately follow it with a comment starting with !*. This way it will be easy to spot what sections will need to be removed.
    Ideology: This application shall be designed as a largely client processed application.
        Implementations: This application shall use stored queries to perform all of it's database accesses.
    Robustness: This application's components shall be developed to a designated level of robustness, i.e. mission critical. This designation recognizes that some features simply may not be worth the effort of 100% success while we can not afford for others to fail. 
