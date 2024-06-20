PHONY: all

checker: checker.c
	gcc -c checker.c -o checker.o

md5: md5.c md5.h
	gcc -c md5.c -o md5.o

all: md5 checker
	gcc -o checker checker.o md5.o

clean:
	rm -f *.o checker

clear:
	rm -f *.o
