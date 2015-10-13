#Survey tool for creating simple survey forms
A simple PHP tool to create simple surveys, complete with prewritten (though hideous) views and a page controller. At this time without any saving option in the survey forms.
This repo is created as a part of a course in PHP MVC frameworks at Blekinge Tekniska Högskola (BTH).

###Requirements
This PHP tool is written with the Anax-MVC framework in mind. To be able to follow the installation guide requires that you have a clean installation of the Anax-MVC framework with the CDatabase service separately installed in the framework. For further reading, please visit [Anax-MVC](https://github.com/mosbth/Anax-MVC "Anax-MVC on GitHub") and [CDatabase](https://github.com/mosbth/cdatabase "CDatabase on GitHub") on GitHub.

###Installation
Add the survey package to your Anax-MVC composer-file:
<pre><code>
    "require": {
        "idun/survey": "dev-master"
    },
</code></pre>

Load the package into the framwork using this line in the terminal program:
<pre><code>
    composer update
</code></pre>

Now you have all the nessesary files in the vendor folder. **BUT** we need to refurnish a bit and move the files from the vendor-folder into the frameworks app-folder, all except the page controller file *survey.php*.

- Move the "Survey"-folder from *idun/survey/src* to *app/src*
- Move the "survey"-folder from *idun/survey/view* to *app/view*
- Move the "survey.php" page controller file from *idun/survey/webroot* to the Anax-MVC webroot-folder.

#####Notice!
The page controller file *survey.php* assumes that you have installed the CDatabase service and that the connection detailes for the service are located in the *app/config* folder in a file called "database_mysql.php", all for a better MVC structure. If this is not the case then change the file location and/or file name in the service injection for the database service in the page controller:
<pre><code>
    $di->setShared('db', function() use ($di) {
        $db = new \Mos\Database\CDatabaseBasic();
        $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
        $db->connect();
        return $db;
    });
</code></pre>

Now you are all set! Just point your browser to the page controller survey.php in the Anax-MVC webroot folder and add the route "setup" the first time (i.e. *Anax-MVC/webroot/survey.php/setup*) to setup the database table and add some content to it.
Welcome to the survey service! =)

###Usage
The survey tool is, as mentioned before, built with the Anax-MVC framework in mind and with the CDatabase service as a layer of protection against SQL injection instead of plain SQL code. This means that the methods in the SurveyController class are based on the CDatabase syntax, and to free the controller from this depencency would mean having to more or less rewrite the entire code. This service is just a test project, so the recommendation is to stick to the present syntax.

