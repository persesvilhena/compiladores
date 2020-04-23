import ply.yacc as yacc
import os
import codecs
import re
from analizadorLexico import tokens
from sys import stdin


def p_program(p):
	'''program : INICIO estrutura FIM'''
	p[0] = p[1:]

def p_estrutura(p):
	'''estrutura : inst
	               | inst estrutura'''
	p[0] = p[1:]

def p_inst(p):
	'''inst : atrib
	        | entrada
	        | saida
	        | cond
	        | repeat'''
	p[0] = p[1:]

def p_atrib(p):
	'''atrib : VAR ATT expre FL'''
	p[0] = p[1:]

def p_entrada(p):
	'''entrada : LEIA AP VAR FP FL'''
	p[0] = p[1:]

def p_saida(p):
	'''saida : ESCREVA AP VAR FP FL'''
	p[0] = p[1:]

def p_cond(p):
	'''cond : SE AP VAR FP AF estrutura FF
	        | SE AP VAR FP AF estrutura FF SENAO AF estrutura FF
	        | SE AP VAR OP_REL VAR FP AF estrutura FF
	        | SE AP VAR OP_REL VAR FP AF estrutura FF SENAO AF estrutura FF
	        | SE AP VAR OP_LOG VAR FP AF estrutura FF
	        | SE AP VAR OP_LOG VAR FP AF estrutura FF SENAO AF estrutura FF'''
	p[0] = p[1:]

def p_repeat(p):
	'''repeat : FOR AP NUMBER FP AF estrutura FF
	          | FOR AP VAR FP AF estrutura FF'''
	p[0] = p[1:]

def p_expre(p):
	'''expre : expre OP_ARI expre
	         | AP expre FP
	         | VAR
	         | VALOR
	         | NUMBER'''
	p[0] = p[1:]

def p_empty(p):
	'''empty :'''
	pass

def p_error(p):
	print "|||Erro sin: ", p

fp = open('src/codigo.ah',"r")
cadena = fp.read()
fp.close()

parser = yacc.yacc()
result = parser.parse(cadena)

print result






