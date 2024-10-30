#!/bin/bash

# Install dependencies
echo "Installing dependencies..."
dnf install -y libjpeg-devel cmake

# Define the QPDF version and URL
QPDF_VERSION="11.9.1"
QPDF_URL="https://github.com/qpdf/qpdf/archive/refs/tags/v${QPDF_VERSION}.tar.gz"

# Download QPDF
echo "Downloading QPDF version ${QPDF_VERSION}..."
wget -O qpdf-${QPDF_VERSION}.tar.gz ${QPDF_URL}

# Extract the downloaded tar.gz file
echo "Extracting QPDF..."
tar -xzvf qpdf-${QPDF_VERSION}.tar.gz
cd qpdf-${QPDF_VERSION}

# Configure and build QPDF
echo "Configuring QPDF build..."
cmake -S . -B build -DCMAKE_BUILD_TYPE=RelWithDebInfo
echo "Building QPDF..."
cmake --build build

# Install QPDF
echo "Installing QPDF..."
cd build
cmake --install .

# Find the installed libqpdf.so.29 file path
echo "Locating libqpdf.so.29..."
LIBQPDF_PATH=$(find / -name "libqpdf.so.29" 2>/dev/null | head -n 1)
echo "libqpdf.so.29 found at: $LIBQPDF_PATH"

# Add library path to /etc/ld.so.conf.d/qpdf.conf
if [ -n "$LIBQPDF_PATH" ]; then
    LIB_DIR=$(dirname "$LIBQPDF_PATH")
    echo "Adding $LIB_DIR to /etc/ld.so.conf.d/qpdf.conf..."
    echo "$LIB_DIR" | tee /etc/ld.so.conf.d/qpdf.conf

    # Update linker cache
    echo "Updating linker cache..."
    ldconfig
else
    echo "libqpdf.so.29 not found; please check if QPDF installed correctly."
fi

# Cleanup downloaded files and build artifacts
echo "Cleaning up downloaded files and build artifacts..."
rm -rf qpdf-${QPDF_VERSION} qpdf-${QPDF_VERSION}.tar.gz

echo "QPDF installation, configuration, and cleanup complete."
