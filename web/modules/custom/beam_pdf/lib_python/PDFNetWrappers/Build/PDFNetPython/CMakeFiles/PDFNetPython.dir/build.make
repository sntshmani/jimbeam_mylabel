# CMAKE generated file: DO NOT EDIT!
# Generated by "Unix Makefiles" Generator, CMake Version 3.10

# Delete rule output on recipe failure.
.DELETE_ON_ERROR:


#=============================================================================
# Special targets provided by cmake.

# Disable implicit rules so canonical targets will work.
.SUFFIXES:


# Remove some rules from gmake that .SUFFIXES does not remove.
SUFFIXES =

.SUFFIXES: .hpux_make_needs_suffix_list


# Suppress display of executed commands.
$(VERBOSE).SILENT:


# A target that is always out of date.
cmake_force:

.PHONY : cmake_force

#=============================================================================
# Set environment variables for the build.

# The shell in which to execute make rules.
SHELL = /bin/sh

# The CMake executable.
CMAKE_COMMAND = /usr/bin/cmake

# The command to remove a file.
RM = /usr/bin/cmake -E remove -f

# Escaping for special characters.
EQUALS = =

# The top-level source directory on which CMake was run.
CMAKE_SOURCE_DIR = /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers

# The top-level build directory on which CMake was run.
CMAKE_BINARY_DIR = /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build

# Include any dependencies generated for this target.
include PDFNetPython/CMakeFiles/PDFNetPython.dir/depend.make

# Include the progress variables for this target.
include PDFNetPython/CMakeFiles/PDFNetPython.dir/progress.make

# Include the compile flags for this target's objects.
include PDFNetPython/CMakeFiles/PDFNetPython.dir/flags.make

PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o: PDFNetPython/CMakeFiles/PDFNetPython.dir/flags.make
PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o: PDFNetPython/PDFNetPython.cpp
	@$(CMAKE_COMMAND) -E cmake_echo_color --switch=$(COLOR) --green --progress-dir=/src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/CMakeFiles --progress-num=$(CMAKE_PROGRESS_1) "Building CXX object PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o"
	cd /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython && /usr/bin/c++  $(CXX_DEFINES) $(CXX_INCLUDES) $(CXX_FLAGS) -o CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o -c /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython/PDFNetPython.cpp

PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.i: cmake_force
	@$(CMAKE_COMMAND) -E cmake_echo_color --switch=$(COLOR) --green "Preprocessing CXX source to CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.i"
	cd /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython && /usr/bin/c++ $(CXX_DEFINES) $(CXX_INCLUDES) $(CXX_FLAGS) -E /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython/PDFNetPython.cpp > CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.i

PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.s: cmake_force
	@$(CMAKE_COMMAND) -E cmake_echo_color --switch=$(COLOR) --green "Compiling CXX source to assembly CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.s"
	cd /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython && /usr/bin/c++ $(CXX_DEFINES) $(CXX_INCLUDES) $(CXX_FLAGS) -S /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython/PDFNetPython.cpp -o CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.s

PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o.requires:

.PHONY : PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o.requires

PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o.provides: PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o.requires
	$(MAKE) -f PDFNetPython/CMakeFiles/PDFNetPython.dir/build.make PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o.provides.build
.PHONY : PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o.provides

PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o.provides.build: PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o


# Object files for target PDFNetPython
PDFNetPython_OBJECTS = \
"CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o"

# External object files for target PDFNetPython
PDFNetPython_EXTERNAL_OBJECTS =

lib/_PDFNetPython.so: PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o
lib/_PDFNetPython.so: PDFNetPython/CMakeFiles/PDFNetPython.dir/build.make
lib/_PDFNetPython.so: ../PDFNetC/Lib/libPDFNetC.so
lib/_PDFNetPython.so: PDFNetPython/CMakeFiles/PDFNetPython.dir/link.txt
	@$(CMAKE_COMMAND) -E cmake_echo_color --switch=$(COLOR) --green --bold --progress-dir=/src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/CMakeFiles --progress-num=$(CMAKE_PROGRESS_2) "Linking CXX shared module ../lib/_PDFNetPython.so"
	cd /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython && $(CMAKE_COMMAND) -E cmake_link_script CMakeFiles/PDFNetPython.dir/link.txt --verbose=$(VERBOSE)

# Rule to build all files generated by this target.
PDFNetPython/CMakeFiles/PDFNetPython.dir/build: lib/_PDFNetPython.so

.PHONY : PDFNetPython/CMakeFiles/PDFNetPython.dir/build

PDFNetPython/CMakeFiles/PDFNetPython.dir/requires: PDFNetPython/CMakeFiles/PDFNetPython.dir/PDFNetPython.cpp.o.requires

.PHONY : PDFNetPython/CMakeFiles/PDFNetPython.dir/requires

PDFNetPython/CMakeFiles/PDFNetPython.dir/clean:
	cd /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython && $(CMAKE_COMMAND) -P CMakeFiles/PDFNetPython.dir/cmake_clean.cmake
.PHONY : PDFNetPython/CMakeFiles/PDFNetPython.dir/clean

PDFNetPython/CMakeFiles/PDFNetPython.dir/depend:
	cd /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build && $(CMAKE_COMMAND) -E cmake_depends "Unix Makefiles" /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/PDFNetPython /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython /src/web/modules/custom/beam_pdf/lib_python/PDFNetWrappers/Build/PDFNetPython/CMakeFiles/PDFNetPython.dir/DependInfo.cmake --color=$(COLOR)
.PHONY : PDFNetPython/CMakeFiles/PDFNetPython.dir/depend
