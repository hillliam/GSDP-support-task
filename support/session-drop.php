<?php

// Finds the session first.
session_start();

// Destroys it by taking out of PHP's memory.
session_destroy();

print "Session has been destroyed!";

