import ply.lex as lex
import re
import codecs
import os
import sys


reserved = {
	'auto':'INICIO',
	'house':'FIM',
	'leia':'LEIA',
	'for':'FOR',
	'escreva':'ESCREVA',
	'se':'SE',
	'senao':'SENAO'
}

tokens = ['ID', 'NUMBER', 'VAR', 'OP_LOG', 'OP_ARI', 'OP_REL', 'ATT', 'VALOR', 'FL', 'AP', 'FP', 'AF', 'FF', 'COMMENT']


tokens = list(reserved.values())+tokens

t_ignore = ' \t'
t_VAR = r'(\#([A-z]+))'
#t_TIPO = r'(int)|(float)|(double)'
# t_SE = r'(se)'
# t_SENAO = r'(senao)'
t_OP_LOG = r'(\&)|(\|)|(no)'
t_OP_ARI = r'\+|\-'
t_ATT = r'(\=)'
t_VALOR = r'(([0-9])+(\.)?([0-9])*)|((\"){1}([A-z]|[0-9]|\s)*(\"){1})'
t_FL = r'(\;)'
t_AP = r'(\()'
t_FP = r'(\))'
t_AF = r'(\[)'
t_FF = r'(\])'
t_OP_REL = r'(\=\=)|(\<)|(\>)|(\>=)|(\<=)|(\!=)'



def t_ID(t):
	r'[a-zA-Z_][a-zA-Z0-9_]*'
	if t.value in reserved:
		t.type = reserved[t.value]
		
	return t

def t_newline(t):
	r'\n+'
	t.lexer.lineno += len(t.value)

def t_COMMENT(t):
	r'((%%)(\s|\w|\d)*(%%))'
	#return t
	pass

def t_NUMBER(t):
	r'\d+'
	t.value = int(t.value)
	return t

def t_error(t):
	print "|||Erro lex: '%s' '%s'" % (t.value[0], t.lexer.lineno)
	t.lexer.skip(1)

lex.lex()
# fp = open('teste.txt',"r")
# cadena = fp.read()
# fp.close()

# analizador = lex.lex()

# analizador.input(cadena)

# while True:
# 	tok = analizador.token()
# 	if not tok : break
# 	print tok
