<?php
/* Copyright © <2011> <singler> <julien>
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA<?php
  */

define("DEBUG", 0);
define("PATH_CONTROLLERS", "application/controllers/");
define("PATH_VIEWS", "application/views/");
define("PATH_MODELS", "application/models/");
define("PATH_LIB", "library/");
define("PATH_LANG", "application/language/");

define("IMAGES", "/public/images");
define("CSS", "/public/css");
define("JS", "/public/js");
define("PATH_ERROR_SQL", PATH_VIEWS."/error/errorSQL.php");
define("PATH_404", PATH_VIEWS."/error/404.html");
define("PATH_NOVIEW", PATH_VIEWS."/error/noView.html");
define("PATH_ERROR", PATH_VIEWS."/error/error.html");

include('define_base.php');
?>
