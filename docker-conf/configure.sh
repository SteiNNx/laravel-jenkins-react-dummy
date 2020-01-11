#!/bin/bash

DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SRC="$(dirname $DIR)/src"

current=
function getCurrent() {
    current=$(ls -la $DIR | grep current | awk '{print $11}')
}

_default=
function getDefault() {
    _default=$(ls -la $DIR | grep 'default' | awk '{print $11}')
    if [ "$_default" = "" ]; then
        _default='docker-compose-prod'
    fi
}

function process() {
    if [ "$(expr substr $(uname -s) 1 10)" == "MINGW32_NT" ]; then
        # Do something under 32 bits Windows NT platform
        cp -f "$DIR/$1/$configfile" "$configfile"
    elif [ "$(expr substr $(uname -s) 1 10)" == "MINGW64_NT" ]; then
        # Do something under 64 bits Windows NT platform
        cp -f "$DIR/$1/$configfile" "$configfile"
    else
        link_src $1 "$DIR/current"
        cd $SRC
        link_src "$DIR/current/$configfile" "../$configfile"
    fi

    echo "New Link to $o"

}

function link_src() {
    local o=$1
    local d=$2
    echo $o
    echo $d

    if [ -L $d ]; then
        unlink $d
    fi

    ln -s $o $d
}

function show() {
    getCurrent
    getDefault
    echo
    echo "Select a manifest folder"
    echo "------------------------"
    echo
    i=1
    for file in $(find $DIR -maxdepth 1 -type d | sed 1d); do
        filename=$(basename $file)
        if [ "$current" == "$filename" ]; then
            p='\033[0;32m'
            star="<-- current "
            nc='\033[0m'
        else
            if [ "$_default" == "$filename" ]; then
                p='\033[1;34m'
                star="<-- default "
                nc='\033[0m'
            else
                nc=""
                p=""
                star=""
            fi
        fi

        printf "$p[%2s] %-30s $star $nc \n" "$i" "$filename"
        i=$(($i + 1))

    done
}

configfile="docker-compose.yml"

[ "$1" != "" ] && [ -d "$DIR/$1" ] && process $1 && exit 0

o=
while [ "$o" == "" ]; do
    show
    echo
    echo -n "Select an option or q to exit :"
    read o
    i=1
    for file in $(find $DIR -maxdepth 1 -type d | sed 1d); do
        if [ "$o" == "$i" ]; then
            echo "Create Link with $(basename $file)"
            process $(basename $file)
        fi
        i=$(($i + 1))
    done

done
