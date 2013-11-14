#!/bin/bash

##
# Modified version of https://gist.github.com/3680107
# 
# Tested for use on Mac OS X 10.7.5 with Bash 3.2.48(1)-release
#
# Old module needs to be in system/cms/modules and a single word (Ex: blogs not site_blogs)
##

##
# Script created by David Lewis (highwayoflife@gmail.com) for PyroCMS
# This script will rename an existing (core) CMS module and duplicate it into the 
# addons/shared_addons/modules directory, while renaming it and all file contents to 
# match
#
# Usage: ./rename_module.sh "old_module" "new_module"
# 
# TODO:
# 1. Ideally, this would work for all plugins/widgets/addons/modules, regardless
#   of location.
# 2. Error-check input and ensure it comes in as lowercase alpha-numeric with 
#   underscores
#
# License: 
# THE SOFTWARE IS PROVIDED TO YOU "AS IS," WITHOUT WARRANTY. THERE IS NO WARRANTY 
# FOR THE SOFTWARE, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE 
# IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE AND 
# NONINFRINGEMENT OF THIRD PARTY RIGHTS. THE ENTIRE RISK AS TO THE QUALITY AND 
# PERFORMANCE OF THE SOFTWARE IS WITH YOU. SHOULD THE SOFTWARE PROVE DEFECTIVE, YOU 
# ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.
# 
##

# Current directory should be PyroCMS
PYROCMS_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
MODULES_DIR="$PYROCMS_PATH/system/cms/modules"
ADDON_MODULES_DIR="$PYROCMS_PATH/addons/shared_addons/modules"

OLD_MODULE="$1"
NEW_MODULE="$2"

if [[ -z "$1" || -z "$1" ]]; then
    echo "Usage: ./rename_module [old-module] [new-module]"
    exit 1
fi

if [ ! -d "$MODULES_DIR" ]; then
    echo "[ ERROR ] Not Found: Modules directory: ($MODULES_DIR)"
    echo "[ ERROR ] Ensure this script is run from the PyroCMS root directory"
    exit 1;
fi

if [ ! -d "$ADDON_MODULES_DIR" ]; then
    echo "[ ERROR ] Not Found: Shared Addons Modules directory: ($ADDON_MODULES_DIR)"
    echo "[ ERROR ] Ensure the $ADDON_MODULES_DIR directory exists"
    exit 1;
fi

if [ ! -d "$MODULES_DIR/$OLD_MODULE" ]; then
    echo "Existing module: '$OLD_MODULE' not found"
    exit 1
fi

echo "Duplicating $OLD_MODULE to '$ADDON_MODULES_DIR/$NEW_MODULE"
cp -a "$MODULES_DIR/$OLD_MODULE" "$ADDON_MODULES_DIR/$NEW_MODULE"

# Run this twice for renamed directories
# TODO: Rather than running multiple times, use while loop
echo "Rename the module files to match $NEW_MODULE"
find "$ADDON_MODULES_DIR/$NEW_MODULE" -name "*blog*" -exec sh -c 'mv "$1" "$(echo "$1" | sed s/'$OLD_MODULE'/'$NEW_MODULE'/)"' _ {} \;
find "$ADDON_MODULES_DIR/$NEW_MODULE" -name "*blog*" -exec sh -c 'mv "$1" "$(echo "$1" | sed s/'$OLD_MODULE'/'$NEW_MODULE'/)"' _ {} \;

LOWER_CASE="$(echo $NEW_MODULE | tr '[:upper:]' '[:lower:]')"
UPPER_CASE="$(echo $NEW_MODULE | tr '[:lower:]' '[:upper:]')"
TITLE_CASE="$(echo $NEW_MODULE | cut -c1 | tr '[[:lower:]]' '[[:upper:]]')"
TITLE_CASE="${TITLE_CASE}$(echo $NEW_MODULE | cut -c2-)"

OLD_LOWER_CASE="$(echo $OLD_MODULE | tr '[:upper:]' '[:lower:]')"
OLD_UPPER_CASE="$(echo $OLD_MODULE | tr '[:lower:]' '[:upper:]')"
OLD_TITLE_CASE="$(echo $OLD_MODULE | cut -c1 | tr '[[:lower:]]' '[[:upper:]]')"
OLD_TITLE_CASE="${OLD_TITLE_CASE}$(echo $OLD_MODULE | cut -c2-)"


echo "Perform find and replace ('s/$OLD_UPPER_CASE/$UPPER_CASE/')"
find "$ADDON_MODULES_DIR/$NEW_MODULE" -name "*" -exec sed -i '' "s/$OLD_UPPER_CASE/$UPPER_CASE/g" {} \;

echo "Perform find and replace ('s/$OLD_TITLE_CASE/$TITLE_CASE/')"
find "$ADDON_MODULES_DIR/$NEW_MODULE" -name "*" -exec sed -i '' "s/$OLD_TITLE_CASE/$TITLE_CASE/g" {} \;

echo "Perform find and replace ('s/$OLD_LOWER_CASE/$LOWER_CASE/')"
find "$ADDON_MODULES_DIR/$NEW_MODULE" -name "*" -exec sed -i '' "s/$OLD_LOWER_CASE/$LOWER_CASE/g" {} \;

echo "Done!"
