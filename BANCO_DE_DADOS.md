# 🗄️ Banco de Dados - Trens de

## Estrutura Criada

### Tabelas
1. **categories** - Armazena categorias de produtos
   - id (PK)
   - name (VARCHAR)
   - slug (VARCHAR, UNIQUE)
   - description (TEXT)
   - created_at, updated_at

2. **products** - Armazena produtos
   - id (PK)
   - category_id (FK → categories)
   - name (VARCHAR)
   - slug (VARCHAR, UNIQUE)
   - description (TEXT)
   - price (DECIMAL)
   - image (VARCHAR, nullable)
   - stock (INT)
   - status (ENUM: active, inactive)
   - created_at, updated_at

### Models Criados
- `CategoryModel.php` - Operações em categorias
- `ProductModel.php` - Operações em produtos

### Migrations
- `2026-04-20-000001_CreateCategoriesTable.php`
- `2026-04-20-000002_CreateProductsTable.php`

### Seeds
- `CategoriesSeeder.php` - 6 categorias padrão
- `ProductsSeeder.php` - 14 produtos de exemplo

---

## 🚀 Como Usar

### 1️⃣ Executar Migrations (criar tabelas)

```bash
php spark migrate
```

### 2️⃣ Popular Banco de Dados com Dados de Exemplo

```bash
php spark db:seed CategoriesSeeder
php spark db:seed ProductsSeeder
```

Ou tudo de uma vez:
```bash
php spark migrate
php spark db:seed CategoriesSeeder
php spark db:seed ProductsSeeder
```

### 3️⃣ Acessar o Painel Admin

**URL:** `http://localhost:8080/admin/dashboard`

### 4️⃣ Funcionalidades do Admin

#### Dashboard (`/admin/dashboard`)
- Visualizar estatísticas (total de produtos, categorias)
- Listar produtos recentes
- Botões de ação rápida

#### Produtos (`/admin/products`)
- ✅ Listar todos os produtos
- ✅ Criar novo produto
- ✅ Editar produto existente
- ✅ Deletar produto
- Status e estoque em destaque

#### Categorias (`/admin/categories`)
- ✅ Listar todas as categorias
- ✅ Criar nova categoria
- ✅ Editar categoria existente
- ✅ Deletar categoria

---

## 📋 Campos dos Produtos

| Campo | Tipo | Obrigatório | Observação |
|-------|------|-------------|-----------|
| category_id | INT | Sim | Referência para categoria |
| name | VARCHAR | Sim | Nome do produto |
| slug | VARCHAR | Sim | URL amigável (único) |
| description | TEXT | Sim | Descrição detalhada |
| price | DECIMAL | Sim | Preço (10,2) |
| image | VARCHAR | Não | URL da imagem |
| stock | INT | Sim | Quantidade disponível |
| status | ENUM | Sim | 'active' ou 'inactive' |

---

## 💡 Exemplos de Uso

### Criar um Novo Produto via Admin

1. Acesse `/admin/products/create`
2. Selecione uma categoria
3. Preencha os dados:
   - Nome: "Fone Gamer RGB"
   - Slug: "fone-gamer-rgb"
   - Descrição: "Fone com LED RGB..."
   - Preço: 189.90
   - Estoque: 10

### Integração com Frontend

Os produtos criados no admin aparecem automaticamente:
- Na home (produtos em destaque)
- Na loja (`/loja`)
- Por categoria (`/categoria/setup`)
- Na página de detalhe (`/produto/1`)

---

## 🔧 Reverter Migrations

Se precisar desfazer as migrações:

```bash
php spark migrate:rollback
```

---

## 📂 Estrutura de Arquivos

```
app/
├── Models/
│   ├── CategoryModel.php
│   └── ProductModel.php
├── Controllers/
│   ├── Home.php
│   ├── Products.php
│   └── Admin.php
├── Views/
│   ├── layout.php
│   ├── home.php
│   ├── products/
│   │   ├── index.php
│   │   ├── category.php
│   │   └── detail.php
│   └── admin/
│       ├── layout.php
│       ├── dashboard.php
│       ├── products/
│       │   ├── index.php
│       │   ├── create.php
│       │   └── edit.php
│       └── categories/
│           ├── index.php
│           ├── create.php
│           └── edit.php
├── Database/
│   ├── Migrations/
│   │   ├── 2026-04-20-000001_CreateCategoriesTable.php
│   │   └── 2026-04-20-000002_CreateProductsTable.php
│   └── Seeds/
│       ├── CategoriesSeeder.php
│       └── ProductsSeeder.php
└── Config/
    └── Routes.php (com as rotas do admin)
```

---

## 🎨 Painel Admin - Cores e Design

- **Cor Primária:** #d32f2f (Vermelho)
- **Cor Secundária:** #2c3e50 (Cinza escuro)
- **Sidébar:** Fixa à esquerda com navegação
- **Cards:** Brancos com sombra
- **Validações:** Mensagens de erro em vermelho
- **Alertas:** Success (verde), Danger (vermelho), Warning (amarelo)

---

## ⚠️ Notas Importantes

1. **Slug deve ser único** - O sistema valida automaticamente
2. **Categorias FK** - Produtos precisam de uma categoria válida
3. **Status padrão** - Novos produtos são criados como "active"
4. **Timestamps** - created_at e updated_at são automáticos
5. **Soft Delete** - Não implementado, deletar é permanente

---

## 📞 Suporte

Se encontrar algum erro ao rodar as migrações:
- Verifique a conexão do banco de dados em `.env`
- Certifique-se que o banco de dados existe
- Rode `php spark migrate --show` para ver status das migrações

