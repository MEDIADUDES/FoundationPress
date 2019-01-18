# FoundationPress

[![GitHub version](https://badge.fury.io/gh/MEDIADUDES%2FFoundationPress.svg)](https://github.com/MEDIADUDES/FoundationPress/releases)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

<p align="center">
  <img width="400" src="screenshot.png">
</p>

This is a starter-theme for WordPress based on Zurb's [Foundation for Sites 6](https://foundation.zurb.com/sites.html), the most advanced responsive (mobile-first) framework in the world. The purpose of FoundationPress, is to act as a small and handy toolbox that contains the essentials needed to build any design. FoundationPress is meant to be a starting point, not the final product.

Please fork, copy, modify, delete, share or do whatever you like with this.

All contributions are welcome!

Huge thanks to [olefredrik](https://github.com/olefredrik/FoundationPress) (and all contributors) to create the base of this starter theme.

## Requirements

**This project requires [Node.js](http://nodejs.org) v8.x.x to be installed on your machine.** Please be aware that you might encounter problems with the installation if you are using the most current Node version (bleeding edge) with all the latest features.

FoundationPress uses [Sass](http://Sass-lang.com/) (CSS with superpowers). In short, Sass is a CSS pre-processor that allows you to write styles more effectively and tidy. FoundationPress uses the SCSS syntax from Sass.

The Sass is compiled using libsass, which requires the GCC to be installed on your machine. Windows users can install it through [MinGW](http://www.mingw.org/), and Mac users can install it through the [Xcode Command-line Tools](http://osxdaily.com/2014/02/12/install-command-line-tools-mac-os-x/).

If you have not worked with a Sass-based workflow before, I would recommend reading [FoundationPress for beginners](https://foundationpress.olefredrik.com/posts/tutorials/foundationpress-for-beginners), a short blog post that explains what you need to know.

## Quickstart

### 1. Clone the repository and install with npm
```bash
$ cd my-wordpress-folder/wp-content/themes/
$ git clone https://github.com/MEDIADUDES/FoundationPress.git
$ cd FoundationPress
$ npm install
$ composer install
$ grunt
```

### 2. Configuration

#### Livereload
If you want to take advantage of automatic browser refresh when a file is saved, simply run the grunt watch task `grunt watch` after installing it in the previous steps. You just need to install e.g. the livereload extension for your browser or include the livereload script manually in your website. More infos can be found [here](http://livereload.com/).

### 3. Get started

```bash
$ npm start
```

### 4. Compile assets for production

When building for production, the CSS and JS will be minified. To minify the assets in your `/dist` folder, run

```bash
$ npm run build
```

#### To create a .zip file of your theme, run: (TODO: implement with grund again. Currently not available.)

```
$ npm run package
```

Running this command will build and minify the theme's assets and place a .zip archive of the theme in the `packaged` directory. This excludes the developer files/directories from your theme like `/node_modules`, `/src`, etc. to keep the theme lightweight for transferring the theme to a staging or production server.

### Project structure

In the `/src` folder you will find the working files for all your assets. Every time you make a change to a file that is watched by Grunt, the output will be saved to the `/dist` folder. The contents of this folder is the compiled code that you should not touch (unless you have a good reason for it).

The `/page-templates` folder contains templates that can be selected in the Pages section of the WordPress admin panel. To create a new page-template, simply create a new file in this folder and make sure to give it a template name.

The rest should be quite self explanatory. Feel free to ask if you feel stuck.

### Styles and Sass Compilation

 * `style.css`: Do not worry about this file. It's required by WordPress to make this theme work properly. All the styling inside this file won't be enqueued. All styling are handled in the Sass files described below:

 * `src/assets/scss/main.scss`: Make imports for all your styles here
 * `src/assets/scss/_settings.scss`: All Foundation component styles can be configured here.
 * `src/assets/scss/global/*.scss`: Global settings. Define your custom variables here. E.g. colors.
 * `src/assets/scss/components/*.scss`: Components like Buttons, Searchbars, Tabs, Accordions, etc. Components are reuseable elements, so design them in a way they can be used independently and in combination with other elements without affecting their appearance.
 * `src/assets/scss/modules/*.scss`: Topbar, footer etc. This are more or less sections or combinations of different components and elements.
 * `src/assets/scss/templates/*.scss`: Page template styling. Styles for individual pages especially the ones in `/page-templates`.

 * `dist/assets/css/main.css`: This file is loaded in the `<head>` section of your document, and contains the compiled styles for your project.

If you're new to Sass, please note that you need to have Grunt running in the background (`npm start`), for any changes in your scss files to be compiled to `main.css`.

### JavaScript Compilation

All JavaScript files, including Foundation's modules, are imported through the `src/assets/js/app.js` file. The files are imported using module dependency with [webpack](https://webpack.js.org/) as the module bundler.

If you're unfamiliar with modules and module bundling, check out [this resource for node style require/exports](http://openmymind.net/2012/2/3/Node-Require-and-Exports/) and [this resource to understand ES6 modules](http://exploringjs.com/es6/ch_modules.html).

Foundation modules are loaded in the `src/assets/js/lib/foundation.js` file. By default all components are loaded. You can also pick and choose which modules to include to decrease the JavaScript file size. Just comment out the modules you don't need and follow the instructions in the file.

If you need to output additional JavaScript files separate from `app.js`, do the following:
* Create new `custom.js` file in `src/assets/js/`. jQuery is automatically included if you use either `jQuery` or `$` variables in your code.
* In `tasks/options/webpack.js`, add the new file as an entry analogous to the `app.js` file.
* Build (`npm start`)
* You will now have a `custom.js` file outputted to the `dist/assets/js/` directory. Remember to enqueue it in `/library/enqueue-scripts.php`.

## Demo

* [Clean FoundationPress install](https://github.com/MEDIADUDES/FoundationPress)
* [FoundationPress Kitchen Sink - see every single element in action](http://foundationpress.olefredrik.com/kitchen-sink/)

## Local Development
We recommend using one of the following setups for local WordPress development:

* [MAMP](https://www.mamp.info/en/) (macOS)
* [WAMP](http://www.wampserver.com/en/download-wampserver-64bits/) (Windows)
* [LAMP](https://www.linux.com/learn/easy-lamp-server-installation) (Linux)
* [Local](https://local.getflywheel.com/) (macOS/Windows)
* [VVV (Varying Vagrant Vagrants)](https://github.com/Varying-Vagrant-Vagrants/VVV) (Vagrant Box)
* [Trellis](https://roots.io/trellis/)

## Resources

* [Foundation UI Kit for Adobe XD](https://gumroad.com/l/foundation-ui-kit-xd)
* [Foundation UI Kit for Axure RP](https://gumroad.com/l/foundation-ui-kit-axure-rp)
* [Foundation UI Kit for Photoshop](https://gumroad.com/l/foundation-ui-kit-psd)
* [Foundation 6 Shortcodes for Visual Composer](https://www.402websites.com/downloads/foundation-6-shortcodes-visual-composer/?ref=2&campaign=Foundation6ShortcodesforVisualComposer)


## Tutorials

* [FoundationPress for beginners](https://foundationpress.olefredrik.com/posts/tutorials/foundationpress-for-beginners/)
* [Responsive images in WordPress with Interchange](http://rachievee.com/responsive-images-in-wordpress/)
* [Learn to use the _settings file to change almost every aspect of a Foundation site](http://zurb.com/university/lessons/66)
* [Other lessons from Zurb University](http://zurb.com/university/past-lessons)

## Documentation

* [Zurb Foundation Docs](http://foundation.zurb.com/docs/)
* [WordPress Codex](http://codex.wordpress.org/)

## Contributing
#### Here are ways to get involved:

1. [Star](https://github.com/MEDIADUDES/FoundationPress/stargazers) the project!
2. Answer questions that come through [GitHub issues](https://github.com/MEDIADUDES/FoundationPress/issues)
3. Report a bug that you find

#### Pull Requests

Pull requests are highly appreciated. Please follow these guidelines:

1. Solve a problem. Features are great, but even better is cleaning-up and fixing issues in the code that you discover
2. Make sure that your code is bug-free and does not introduce new bugs
3. Create a [pull request](https://help.github.com/articles/creating-a-pull-request)
4. Verify that all the Travis-CI build checks have passed
