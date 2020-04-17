
# parsetab.py
# This file is automatically generated. Do not edit.

_lr_method = 'LALR'

_lr_signature = '\xebbh\x9d/Nc\xafN\xdd\xc3?\xdeb\xdd\xc7'

_lr_action_items = {'FP':([22,23,24,26,28,29,30,31,37,45,46,49,50,],[32,33,34,-24,-23,-22,38,39,46,-20,-21,54,55,]),'OP_REL':([31,],[40,]),'ESCREVA':([2,3,5,6,7,8,10,36,42,43,44,47,48,56,57,58,59,60,64,65,66,70,71,72,75,76,],[4,-4,-7,-6,-5,-8,4,-9,-11,4,4,-10,4,-18,-19,-12,4,4,4,-14,-16,-13,4,4,-15,-17,]),'FOR':([2,3,5,6,7,8,10,36,42,43,44,47,48,56,57,58,59,60,64,65,66,70,71,72,75,76,],[9,-4,-7,-6,-5,-8,9,-9,-11,9,9,-10,9,-18,-19,-12,9,9,9,-14,-16,-13,9,9,-15,-17,]),'OP_LOG':([31,],[41,]),'SENAO':([58,65,66,],[61,68,69,]),'FIM':([3,5,6,7,8,10,13,17,36,42,47,56,57,58,65,66,70,75,76,],[-4,-7,-6,-5,-8,-2,20,-3,-9,-11,-10,-18,-19,-12,-14,-16,-13,-15,-17,]),'VALOR':([18,27,35,],[28,28,28,]),'AF':([33,34,39,54,55,61,68,69,],[43,44,48,59,60,64,71,72,]),'NUMBER':([16,18,27,35,],[23,26,26,26,]),'AP':([4,9,12,14,18,27,35,],[15,16,19,21,27,27,27,]),'ATT':([11,],[18,]),'FF':([3,5,6,7,8,10,17,36,42,47,51,52,53,56,57,58,62,63,65,66,67,70,73,74,75,76,],[-4,-7,-6,-5,-8,-2,-3,-9,-11,-10,56,57,58,-18,-19,-12,65,66,-14,-16,70,-13,75,76,-15,-17,]),'INICIO':([0,],[2,]),'VAR':([2,3,5,6,7,8,10,15,16,18,19,21,27,35,36,40,41,42,43,44,47,48,56,57,58,59,60,64,65,66,70,71,72,75,76,],[11,-4,-7,-6,-5,-8,11,22,24,29,30,31,29,29,-9,49,50,-11,11,11,-10,11,-18,-19,-12,11,11,11,-14,-16,-13,11,11,-15,-17,]),'OP_ARI':([25,26,28,29,37,45,46,],[35,-24,-23,-22,35,35,-21,]),'LEIA':([2,3,5,6,7,8,10,36,42,43,44,47,48,56,57,58,59,60,64,65,66,70,71,72,75,76,],[12,-4,-7,-6,-5,-8,12,-9,-11,12,12,-10,12,-18,-19,-12,12,12,12,-14,-16,-13,12,12,-15,-17,]),'FL':([25,26,28,29,32,38,45,46,],[36,-24,-23,-22,42,47,-20,-21,]),'SE':([2,3,5,6,7,8,10,36,42,43,44,47,48,56,57,58,59,60,64,65,66,70,71,72,75,76,],[14,-4,-7,-6,-5,-8,14,-9,-11,14,14,-10,14,-18,-19,-12,14,14,14,-14,-16,-13,14,14,-15,-17,]),'$end':([1,20,],[0,-1,]),}

_lr_action = { }
for _k, _v in _lr_action_items.items():
   for _x,_y in zip(_v[0],_v[1]):
      if not _lr_action.has_key(_x):  _lr_action[_x] = { }
      _lr_action[_x][_k] = _y
del _lr_action_items

_lr_goto_items = {'atrib':([2,10,43,44,48,59,60,64,71,72,],[3,3,3,3,3,3,3,3,3,3,]),'estrutura':([2,10,43,44,48,59,60,64,71,72,],[13,17,51,52,53,62,63,67,73,74,]),'expre':([18,27,35,],[25,37,45,]),'saida':([2,10,43,44,48,59,60,64,71,72,],[6,6,6,6,6,6,6,6,6,6,]),'program':([0,],[1,]),'cond':([2,10,43,44,48,59,60,64,71,72,],[5,5,5,5,5,5,5,5,5,5,]),'entrada':([2,10,43,44,48,59,60,64,71,72,],[7,7,7,7,7,7,7,7,7,7,]),'inst':([2,10,43,44,48,59,60,64,71,72,],[10,10,10,10,10,10,10,10,10,10,]),'repeat':([2,10,43,44,48,59,60,64,71,72,],[8,8,8,8,8,8,8,8,8,8,]),}

_lr_goto = { }
for _k, _v in _lr_goto_items.items():
   for _x,_y in zip(_v[0],_v[1]):
       if not _lr_goto.has_key(_x): _lr_goto[_x] = { }
       _lr_goto[_x][_k] = _y
del _lr_goto_items
_lr_productions = [
  ("S'",1,None,None,None),
  ('program',3,'p_program','.\\analizadorSintactico.py',23),
  ('estrutura',1,'p_estrutura','.\\analizadorSintactico.py',27),
  ('estrutura',2,'p_estrutura','.\\analizadorSintactico.py',28),
  ('inst',1,'p_inst','.\\analizadorSintactico.py',32),
  ('inst',1,'p_inst','.\\analizadorSintactico.py',33),
  ('inst',1,'p_inst','.\\analizadorSintactico.py',34),
  ('inst',1,'p_inst','.\\analizadorSintactico.py',35),
  ('inst',1,'p_inst','.\\analizadorSintactico.py',36),
  ('atrib',4,'p_atrib','.\\analizadorSintactico.py',40),
  ('entrada',5,'p_entrada','.\\analizadorSintactico.py',45),
  ('saida',5,'p_saida','.\\analizadorSintactico.py',49),
  ('cond',7,'p_cond','.\\analizadorSintactico.py',53),
  ('cond',11,'p_cond','.\\analizadorSintactico.py',54),
  ('cond',9,'p_cond','.\\analizadorSintactico.py',55),
  ('cond',13,'p_cond','.\\analizadorSintactico.py',56),
  ('cond',9,'p_cond','.\\analizadorSintactico.py',57),
  ('cond',13,'p_cond','.\\analizadorSintactico.py',58),
  ('repeat',7,'p_repeat','.\\analizadorSintactico.py',62),
  ('repeat',7,'p_repeat','.\\analizadorSintactico.py',63),
  ('expre',3,'p_expre','.\\analizadorSintactico.py',67),
  ('expre',3,'p_expre','.\\analizadorSintactico.py',68),
  ('expre',1,'p_expre','.\\analizadorSintactico.py',69),
  ('expre',1,'p_expre','.\\analizadorSintactico.py',70),
  ('expre',1,'p_expre','.\\analizadorSintactico.py',71),
  ('empty',0,'p_empty','.\\analizadorSintactico.py',75),
]