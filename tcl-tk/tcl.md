TCL
====

### puts ###

    puts "Hello, World - In quotes"    ;# This is a comment after the command.
	# This is a comment at beginning of a line
	puts {Hello, World - In Braces}
	puts {Bad comment syntax example}   # *Error* - there is no semicolon!
	
	puts "This is line 1"; puts "this is line 2"
	
	puts "Hello, World; - With  a semicolon inside the quotes"
	
	# Words don't need to be quoted unless they contain white space:
	puts HelloWorld

### 变量赋值 ###

语法: set ***varName*** ***?value?***

- If *value* is specified, then the contents of the variable varName are set equal to value .
- If *varName* consists only of alphanumeric characters, and no parentheses, it is a scalar variable.
- If *varName* has the form **varName(index)** , it is a member of an associative **array**.

示例:

    set X "This is a string"

	set Y 1.24
	
	puts $X
	puts $Y
	
	puts "..............................."
	
	set label "The value in Y is: "
	puts "$label $Y"

### 字符串: "" 和 {} ###

	set Z Albany
	set Z_LABEL "The Capitol of New York is: "
	
	puts "\n................. examples of differences between  \" and \{"
	puts "$Z_LABEL $Z"
	puts {$Z_LABEL $Z}
	
	puts "\n....... examples of differences in nesting \{ and \" "
	puts "$Z_LABEL {$Z}"
	puts {Who said, "What this country needs is a good $0.05 cigar!"?}
	
	puts "\n................. examples of escape strings"
	puts {There are no substitutions done within braces \n \r \x0a \f \v}
	puts {But, the escaped newline at the end of a\
	string is still evaluated as a space}

### if ###

### switch ###

### while ###

### for 和 incr ###

    for {set i 0} {$i < 10} {incr i} {
        puts "I inside first loop: $i"
    }

### list ###

	set b [list a b {c d e} {f {g h}}]
	puts "Treated as a list: $b\n"
	
	set b [split "a b {c d e} {f {g h}}"]
	puts "Transformed by split: $b\n"
	
	set a [concat a b {c d e} {f {g h}}]
	puts "Concated: $a\n"
	
	lappend a {ij K lm}                        ;# Note: {ij K lm} is a single element
	puts "After lappending: $a\n"
	
	set b [linsert $a 3 "1 2 3"]               ;# "1 2 3" is a single element
	puts "After linsert at position 3: $b\n"
	
	set b [lreplace $b 3 5 "AA" "BB"]
	puts "After lreplacing 3 positions with 2 values at position 3: $b\n"

