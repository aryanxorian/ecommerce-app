#!/usr/bin/env bash

cd /ecommerce-app/

echo "Running specification tests..."
# run specification tests.
./phpspec run tests/specifications/
