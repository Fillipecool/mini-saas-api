# Convenções de Código e Desenvolvimento

Este documento define as convenções de código, nomenclatura de branches e práticas de desenvolvimento a serem seguidas no projeto.

## Convenções de Comentários

### DocBlocks e PHPDoc

- Todas as classes, métodos e funções devem ter DocBlocks
- Use o formato PHPDoc completo para funções e métodos:

```php
/**
 * Brief description of the function/method
 *
 * More detailed description if necessary
 *
 * @param string $param1 Parameter description
 * @param int $param2 Parameter description
 * @return bool Return description
 * @throws \Exception When an error occurs
 */
public function exampleMethod(string $param1, int $param2): bool
{
    // Implementation
}
```

### Comentários Inline

- Use comentários inline para explicar "por que" e não "o que" o código faz
- Prefira código autoexplicativo ao invés de comentários extensos
- Mantenha comentários atualizados com o código

### TODOs e FIXMEs

- Use `// TODO - description` para marcar melhorias futuras
- Use `// FIXME - description` para marcar problemas que precisam ser corrigidos
- Use `// NOTE - description` fornece contexto ou explicação adicional sobre uma decisão de implementação

- Inclua tickets/issues quando possível: `// TODO - Implementar validação de CEP (#123)`

## Convenções de Branches

### Estrutura de Branches

- `main` - Branch principal, contém código em produção
- `develop` - Branch de desenvolvimento, contém código em teste
- Branches de feature, bugfix, etc. são criadas a partir de `develop`

### Nomenclatura de Branches

Use o formato:

```
<tipo>/<referência>-<descrição-breve>
```

Onde:
- `<tipo>` pode ser:
  - `feature/` - Nova funcionalidade
  - `bugfix/` - Correção de bug
  - `hotfix/` - Correção urgente em produção
  - `release/` - Preparação para release
  - `refactor/` - Refatoração de código
  - `docs/` - Atualização de documentação
  - `test/` - Adição ou modificação de testes

- `<referência>` é o número do ticket/issue (se aplicável)
- `<descrição-breve>` é uma descrição curta em kebab-case (palavras separadas por hífens)

#### Exemplos:

✅ Bons exemplos:
```
feature/123-implement-notification-system
bugfix/456-fix-tax-calculation
hotfix/789-resolve-login-issue
docs/update-readme
refactor/auth-module
```

❌ Exemplos a evitar:
```
new-feature
fixing_bug
my_branch
temp
```

## Convenções de Commits

### Estrutura de Mensagem de Commit

Use o formato:

```
<tipo>: <descrição curta>

<corpo da mensagem>

<rodapé>
```

Onde:
- `<tipo>` pode ser: `feat`, `fix`, `docs`, `style`, `refactor`, `test`, `chore`
- `<descrição curta>` é uma descrição concisa no modo imperativo
- `<corpo da mensagem>` é opcional, contendo detalhes adicionais
- `<rodapé>` é opcional, para referências a issues/tickets

### Exemplos:

```
feat: add two-factor authentication system

Implements authentication with Google Authenticator to ensure 
greater security in accessing the admin panel.

Ref #123
```

```
fix: correct tax calculation in invoices

The value was being calculated incorrectly for imported products.
```

## Padrões de Codificação PHP

- Seguimos as [PSR-12](https://www.php-fig.org/psr/psr-12/) para padrões de codificação
- Utilizamos o Laravel Pint para formatação automática
- Indentação com 4 espaços (não tabs)
- Limite de 80-120 caracteres por linha
- Namespace no padrão `App\Domain\Subdomain`

## Workflow de Desenvolvimento

1. Crie uma branch a partir de `develop` seguindo a convenção de nomenclatura
2. Desenvolva e faça commits frequentes
3. Mantenha sua branch atualizada com `develop` (rebase regularmente)
4. Crie um Pull Request quando a feature estiver completa
5. PR deve passar em todos os testes automatizados e revisão de código
6. Faça merge após aprovação

## Comandos Git Úteis

```bash
# Criar uma nova branch
git checkout -b feature/123-my-feature develop

# Atualizar sua branch com develop (prefira rebase)
git pull origin develop

# Verificar status
git status

# Adicionar arquivos modificados
git add .

# Commit seguindo convenções
git commit -m "feat: add functionality X"

# Enviar para o repositório remoto
git push origin feature/123-my-feature
```

---

Estas convenções devem ser seguidas por todos os membros da equipe para manter a consistência do código e facilitar a colaboração.
