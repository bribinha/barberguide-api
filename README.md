# BarberGuide API (Laravel)

API RESTful robusta desenvolvida com Laravel 10 para servir como backend de uma aplicação de agendamentos de barbearias
e cabeleleiros. Este projeto demonstra uma arquitetura de API limpa, lógica de negócio complexa e uma base sólida para
funcionalidades avançadas como autenticação e notificações.

![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue?logo=php)
![Laravel](https://img.shields.io/badge/Laravel-10.x-orange?logo=laravel)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15-blue?logo=postgresql)
![PHPUnit](https://img.shields.io/badge/Testes-PHPUnit-green?logo=phpunit)

---

### 📋 Tabela de Conteúdos

1. [Sobre o Projeto](#-sobre-o-projeto)
2. [Principais Habilidades Demonstradas](#-principais-habilidades-demonstradas)
3. [Tech Stack](#-tech-stack)
4. [Como Executar Localmente](#-como-executar-localmente)
5. [Rodando os Testes](#-rodando-os-testes)
6. [Endpoints da API](#-endpoints-da-api)
7. [Próximos Passos](#-próximos-passos)

---

### ✨ Sobre o Projeto

Este backend foi construído para gerenciar toda a lógica de um sistema de agendamentos, fornecendo endpoints seguros e
eficientes para uma interface de frontend (SPA). O foco foi em escrever um código limpo, testável e escalável.

### 🚀 Principais Habilidades Demonstradas

* **Arquitetura de API RESTful:** Design de endpoints seguindo as melhores práticas, utilizando Resources e Form
  Requests do Laravel.
* **Lógica de Negócio Complexa:** Implementação do algoritmo de cálculo de horários disponíveis, considerando o
  expediente do profissional e os agendamentos já existentes.
* **Autenticação para SPAs:** Configuração completa do **Laravel Sanctum** e **CORS** para garantir a comunicação segura
  com um frontend desacoplado.
* **Testes de Funcionalidade (TDD):** Cobertura de testes para os endpoints críticos da aplicação usando **PHPUnit**,
  garantindo a confiabilidade e facilitando a manutenção.
* **Manipulação de Banco de Dados:** Uso do Eloquent ORM com relacionamentos, migrations e seeders para um gerenciamento
  de dados eficiente e consistente com PostgreSQL.

### 🛠️ Tech Stack

* **PHP 8.1+**
* **Laravel 10**
* **PostgreSQL 15**
* **Laravel Sanctum** (Autenticação)
* **PHPUnit** (Testes)

### ⚙️ Como Executar Localmente

**Pré-requisitos:**

* PHP >= 8.1
* Composer
* PostgreSQL

**Passos:**

1. Clone o repositório: `git clone https://github.com/bribinha/barberguide-api`
2. Navegue até a pasta: `cd barberguide-api`
3. Instale as dependências: `composer install`
4. Copie o arquivo de ambiente: `cp .env.example .env`
5. Gere a chave da aplicação: `php artisan key:generate`
6. Configure suas credenciais do PostgreSQL no arquivo `.env`.
7. Execute as migrações e popule o banco: `php artisan migrate --seed`
8. Inicie o servidor de desenvolvimento: `php artisan serve`
    * A API estará disponível em `http://127.0.0.1:8000/api`

### 🧪 Rodando os Testes

Para executar a suíte de testes de funcionalidade, rode:

```bash
php artisan test
