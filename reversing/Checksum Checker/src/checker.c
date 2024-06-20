#include <stdint.h>
#include <stdio.h>
#include <string.h>

#include "md5.h"

int main(int argc, char *argv[]) {
  uint8_t result[16];
  char stringRes[33];
  stringRes[32] = 0;
  char *patata = "es_esta_la_flag?";

  if (argc <= 1) {
    printf("Usage:\n./checker <clave>");
    return -1;
  }

  md5String(patata, result);
  for(unsigned int i = 0; i < 16; ++i){
    sprintf(stringRes+i*2, "%02x", result[i]);
  }

  char same = 1;
  if (strlen(argv[1]) < 32) same = 0;
  for (int i = 0; i < 32 && same; i++){
    if (argv[1][i] != stringRes[i]) same=0;
  }

  if (same){
    argv[1][32] = 0;
    printf("Correcto, la flag es letsctf{%s}\n", argv[1]);
  } else{
    printf("Incorrecto, vuelve a intentarlo mas tarde.");
  }

  return 0;
}
