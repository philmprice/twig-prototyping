twig-prototyping
================

Use Twig to create HTML Wireframes.

Overview
--------

This project was created as a proof-of-concept to see how well Twig could be used to drive prototyping at SiteCrafting (http://www.sitecrafting.com). It leverages Twig (http://twig.sensiolabs.org/) to render the templates, bootstrap (http://getbootstrap.com/) to give things a stylish and responsive feel, and borrows a usability/workflow concepts from Pattern Lab (http://patternlab.io/).

View Organization
-----------------

Views are organized with the atomic design pattern (http://patternlab.io/about.html) with one exception: the concept for 'templates' has been moved up to encompass pages.

How to Use
----------

Fill the atomic design pattern up with views, put the views together using the Twig language, browse your views by using the top menu, or preview pages by appending the URL with the page name (ie. '/twig-prototyping/blog' will load up the 'blog.twig' page).

Default Data
------------

If you provide a page (.twig) file with an accompanying data (.json) file (ie. 'blog.json' to accompany 'blog.twig') that JSON data will be read and sent to Twig as display data.