## WordPress Development Base Project

### Prerequisites

You'll need to have:

* A webserver with PHP enabled (enabling PHP on OS X <http://www.php.net/manual/en/install.macosx.bundled.php>)
* MySQL (install Homebrew <http://brew.sh/> then run `brew install mysql`)
* Node (probably easiest to use NVM <https://github.com/creationix/nvm>, remember to set a default node version)
* The Grunt command line tool - after installing node via NVM run the following command:
`npm install grunt-cli -g`

Optional: install Sequel Pro <http://www.sequelpro.com/> which is a nice MySQL admin app.

### Development Environment Setup

#### Wordpress Config

1. Copy `wp-config-sample.php` to `wp-config.php`.
1. Go to <https://api.wordpress.org/secret-key/1.1/salt/> and generate new authentication keys and salts, then paste them into `wp-config.php` in the appropriate place.
1. Create MySQL database, make sure it's UTF-8 format.
1. Either use the default mysql user (if your just using a local installation) or create a new DB user with read & write permissoins for database 
1. Add all the database access details to wp-config.php
1. Serve through your webserver of choice (see below).

#### Serving Setup

We don't have time to go into this fully here but a simple setup for Apache on OS X:

Edit __/private/etc/hosts__

    127.0.0.1 wordpress_dev_base.site

Edit __/private/etc/apache2/httpd.conf__

_Warning_: remember to edit the DocumentRoot and Directory paths to point to the Wordpress root on your machine

        <VirtualHost *:80>
            ServerName wordpress_dev_base.site
            DocumentRoot "/projects/projectname/www" 
          <Directory "/projects/projectname/www">
            Options Indexes FollowSymLinks Multiviews
            AllowOverride All
            Order allow,deny
            Allow from all
          </Directory>
        </VirtualHost>

And lastly check your permissions on the WP root, the enclosing folder and the PHP files. Remember the uploads folder needs to writable by the server.

Finally, restart Apache `sudo apachectl restart`

#### Wordpress Setup

1. Go to <http://wordpress_dev_base.site/wp-admin> and follow instructions/login
1. Go to _Appearance->Themes_ and activate the 'DSB Wordpress Base Theme' theme
1. On the Roots theme options page that appears after activation say No to 'change uploads folder location', leave the others at yes
1. Go to _Plugins_ and activate Wordpress Importer plugin
1. Find the sample post data - you'll find it in `/assets/test_theme_data/wordpressdevbase.wordpress.xml` - and replace all instances of `http://wordpress_dev_base.site` with your site url
1. Import the test data into WordPress


### Development

This theme is set up to use NPM, Grunt & Sass.

All the following work is done in the main them folder which is at  
`/wp-content/themes/base-theme`

#### Installing Dependencies using NPM

The theme uses a few libraries and uses NPM to manage them, just run the following command from the root theme folder to install all the dependencies - these aren't checked into the git repo so you'll need to do this anytime you clone it.

    npm install
    
This only needs to be done once per project.

#### Using Grunt for development

Grunt is a build tool that allows us to automatically do all the useful things we need to do to have a good development experience and a fast, responsive site.

In this theme Grunt helps us by:

* Compiling our SASS files
* Compressing our JavaScript to speed up our site
* Version our assets so when we deploy we don't have caching issues
* Watching our files for changes and automatically running the above steps
* Runs a LiveReload page to refresh our page automatically (you'lll need to install the [Chrome Extension](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei?hl=en) to make it work) 

To run the build process automatically when you change any files in development use the following command:

    grunt dev

This will watch any changes you make to the files and update the live code.

You can also just build for distribution by running grunt without any arguments: 

    grunt 


##### SASS & Bootstrap

This project uses SASS, find the basics of using SASS at <http://sass-lang.com/guide>. 

When editing the styles you should only edit /assets/sass/app.scss or other files in the sass folder

__TOP TIP__: It's helpful to use Chrome and enable source maps <https://developer.chrome.com/devtools/docs/css-preprocessors#toc-enabling-css-source-maps> - then you'll see the .scss file line numbers in the Chrome Developer Tools inspector. You should only have to do this once.

You'll see at the top of the `app.scss` file an import statement:

    @import "../../node_modules/bootstrap-sass/vendor/assets/stylesheets/bootstrap";

This pulls in the Bootstrap framework files from the `bootstrap-sass` project. Find out how to use Bootstrap framework at <http://getbootstrap.com>.

#### Theme Development & Roots

You're all set to get cracking on developing a new theme - here's some useful reference for the tricky bits:

__Basics__

* Theme Development: <http://codex.wordpress.org/Theme_Development>
* Template Hierarchy: <http://codex.wordpress.org/Template_Hierarchy>

__Roots__

* Roots Theme 101: <http://roots.io/roots-101/>
* Roots Theme Wrapper: <http://roots.io/an-introduction-to-the-roots-theme-wrapper/>
* Roots Sidebar Setup: <http://roots.io/the-roots-sidebar/>
* Modifying Bootstrap in Roots: <http://roots.io/modifying-bootstrap-in-roots/> 

#### Useful Stuff in `functions.php`

`/functions.php` has a lot of useful functions, it's commented so just look at the file to see how to do several useful things such as:

* Change default image display config
* Add custom image sizes
* Add custom image sizes to media selection UI
* Add custom post types & custom taxonomies
* Add custom metaboxes using WP-Alchemy <http://www.farinspace.com/wpalchemy-metabox/>

### Other Useful Theme Development Links

* Using wp_query: <http://codex.wordpress.org/Class_Reference/WP_Query>
* WP Codex Theme Articles Index: <http://codex.wordpress.org/Templates>
