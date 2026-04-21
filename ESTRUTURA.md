# 📋 Estrutura do Projeto Trens de

## Estrutura de Pastas Criada

```
app/
├── Controllers/
│   ├── BaseController.php
│   ├── Home.php
│   └── Products.php (NOVO)
├── Models/
│   └── (será usado para banco de dados)
├── Views/
│   ├── layout.php (MELHORADO)
│   ├── home.php (MELHORADO)
│   └── products/
│       ├── index.php (NOVO - Loja)
│       ├── category.php (NOVO - Categoria)
│       └── detail.php (NOVO - Detalhe do Produto)
```

## Funcionalidades Implementadas

### ✅ Frontend
- **Layout Principal** (`layout.php`)
  - Header com logo, busca, menu e ações
  - Footer com seções institucional, ajuda, pagamento e redes sociais
  - Design responsivo e moderno (cores: vermelho #d32f2f, cinza #2c3e50)

- **Página Home** (`home.php`)
  - Seção hero com bem-vindo
  - 6 Categorias principais com cards
  - Seção de benefícios (frete grátis, devoluções, parcelamento, segurança)
  - 4 Produtos em destaque

- **Página Loja** (`products/index.php`)
  - Grid de 12 produtos com filtros
  - Botões para filtrar por categoria
  - Cards com preço e ações

- **Página Categoria** (`products/category.php`)
  - Lista de 8 produtos por categoria
  - Link para voltar à loja

- **Página Detalhe** (`products/detail.php`)
  - Imagem do produto (grande)
  - Descrição e preço
  - Seletor de quantidade
  - Botões de compra e favorito
  - Informações de entrega
  - Produtos relacionados

### 🔗 Rotas (a implementar em `app/Config/Routes.php`)
```
GET  /              → Home::index()
GET  /loja          → Products::index()
GET  /categoria/:name → Products::category($name)
GET  /produto/:id   → Products::detail($id)
```

## Próximos Passos

1. **Configurar Banco de Dados**
   - Criar tabelas: `products`, `categories`, `cart`, `orders`
   - Usar migrations do CodeIgniter

2. **Criar Modelos**
   - `ProductModel.php`
   - `CategoryModel.php`
   - `CartModel.php` (opcional)

3. **Integrar com Backend**
   - Conectar controllers aos modelos
   - Buscar dados reais do BD
   - Implementar carrinho e checkout

4. **Segurança**
   - Validação de formulários
   - Proteção CSRF
   - Autenticação de usuário

## Cores da Marca
- Vermelho Primário: `#d32f2f`
- Cinza Escuro: `#2c3e50`
- Branco: `#ffffff`
- Cinza Claro: `#f5f5f5`
- Cinza Borda: `#ddd`

## Ícones Utilizados
- 🚂 Logo
- 🛍️ Loja
- 🎯 Categorias
- ✨ Destaques
- 🚚 Frete
- 🔄 Devoluções
- 💳 Pagamento
- 🔒 Segurança
