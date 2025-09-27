import mysql.connector
import google.generativeai as genai


genai.configure(api_key="AIzaSyBLfK5mjajyfactwntCenqegZ6oYfPCVxA")
model = genai.GenerativeModel("gemini-2.5-flash")

conn = mysql.connector.connect(
    host="localhost",
    port = "3306",
    user="root",
    password="",
    database="redoma"
)

cursor = conn.cursor(dictionary=True)

evento_id = int(input("Digite o ID do evento que deseja atender: "))
# 1. Puxar evento + cliente
cursor.execute("""
SELECT e.id, e.tipo_evento, e.orcamento, e.qnt_pessoas,
       c.nome AS cliente, c.telefone, c.email
FROM evento e
JOIN cliente c ON e.id_cliente = c.id
WHERE e.id = %s
""", (evento_id,))
evento = cursor.fetchone()

# 2. Puxar recursos disponíveis
cursor.execute("""
SELECT r.id, r.nome, r.descricao, r.preco,
       CASE
           WHEN s.id_recurso IS NOT NULL THEN 'servico'
           WHEN p.id_recurso IS NOT NULL THEN 'produto'
           WHEN l.id_recurso IS NOT NULL THEN 'local'
           ELSE 'outro'
       END AS tipo
FROM recurso r
LEFT JOIN servico s ON r.id = s.id_recurso
LEFT JOIN produto p ON r.id = p.id_recurso
LEFT JOIN local l ON r.id = l.id_recurso
WHERE r.ativo = 1
""")
recursos = cursor.fetchall()

# Montar prompt
prompt = f"""
Você é um planejador de eventos.
O cliente tem o seguinte evento:
{evento}

Orçamento do cliente: R$ {evento['orcamento']}

Aqui estão os recursos disponíveis:
{recursos}

Monte no mínimo 3 opções de pacotes diferentes para esse evento.
Cada pacote deve conter:
- Lista de recursos escolhidos (somente os nomes)
- Preço total estimado em R$ (apenas números)
- Breve justificativa, com no máximo 2 frases
- Inclua os ID de recurso de cada um

Regras IMPORTANTES:
- O Pacote 1 deve ter preço total menor ou igual ao orçamento.
- O Pacote 2 deve ter preço total o mais próximo possível do orçamento, sem ultrapassar.
- O Pacote 3 deve ter preço total acima do orçamento (pode ultrapassar até 30%, não cite essa informação).
- Sempre some os valores dos recursos para calcular o preço total, não invente valores sem somar.

Cite o valor do orçamento logo no início, junto ao nome do cliente.

Formato de resposta esperado:

Pacote 1:
Recursos:
- Recurso 1 -> R$ x
- Recurso 2 -> R$ y
Preço total: R$ z
Justificativa: ...

Pacote 2:
Recursos:
- ...
Preço total: ...
Justificativa: ...

Pacote 3:
Recursos:
- ...
Preço total: ...
Justificativa: ...
"""

# Mandar para o Gemini
resposta = model.generate_content(prompt)
print(resposta.text)