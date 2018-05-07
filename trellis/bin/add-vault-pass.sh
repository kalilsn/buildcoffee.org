#!/bin/bash

read -s -p "Ansible vault password:" password
echo $password > .vault_pass
"$@"
rm -f .vault_pass
