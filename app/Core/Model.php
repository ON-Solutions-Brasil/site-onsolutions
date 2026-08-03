<?php

namespace App\Core;

/**
 * Model base da aplicação.
 * Todos os models devem estender esta classe.
 */
abstract class Model
{
    protected Database $db;
    protected string $table = '';
    protected string $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Busca registro por ID.
     */
    public function find(int $id): ?array
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?",
            [$id]
        );
    }

    /**
     * Retorna todos os registros.
     */
    public function all(string $orderBy = 'id', string $direction = 'DESC'): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$direction}"
        );
    }

    /**
     * Retorna registros com paginação.
     */
    public function paginate(int $page = 1, int $perPage = 15, string $orderBy = 'id', string $direction = 'DESC'): array
    {
        $offset = ($page - 1) * $perPage;

        $total = $this->db->fetch("SELECT COUNT(*) as total FROM {$this->table}");
        $totalRecords = (int) ($total['total'] ?? 0);
        $totalPages = (int) ceil($totalRecords / $perPage);

        $records = $this->db->fetchAll(
            "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$direction} LIMIT ? OFFSET ?",
            [$perPage, $offset]
        );

        return [
            'data'        => $records,
            'total'       => $totalRecords,
            'per_page'    => $perPage,
            'current_page'=> $page,
            'total_pages' => $totalPages,
        ];
    }

    /**
     * Busca registros por condição.
     */
    public function where(string $column, mixed $value, string $operator = '='): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table} WHERE {$column} {$operator} ?",
            [$value]
        );
    }

    /**
     * Busca um único registro por condição.
     */
    public function findBy(string $column, mixed $value): ?array
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE {$column} = ? LIMIT 1",
            [$value]
        );
    }

    /**
     * Cria um novo registro.
     */
    public function create(array $data): int
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Atualiza um registro.
     */
    public function update(int $id, array $data): int
    {
        return $this->db->update(
            $this->table,
            $data,
            "{$this->primaryKey} = ?",
            [$id]
        );
    }

    /**
     * Exclui um registro.
     */
    public function delete(int $id): int
    {
        return $this->db->delete(
            $this->table,
            "{$this->primaryKey} = ?",
            [$id]
        );
    }

    /**
     * Conta total de registros.
     */
    public function count(string $where = '1=1', array $params = []): int
    {
        $result = $this->db->fetch(
            "SELECT COUNT(*) as total FROM {$this->table} WHERE {$where}",
            $params
        );
        return (int) ($result['total'] ?? 0);
    }

    /**
     * Verifica se existe registro.
     */
    public function exists(string $column, mixed $value, ?int $excludeId = null): bool
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE {$column} = ?";
        $params = [$value];

        if ($excludeId !== null) {
            $sql .= " AND {$this->primaryKey} != ?";
            $params[] = $excludeId;
        }

        $result = $this->db->fetch($sql, $params);
        return (int) ($result['total'] ?? 0) > 0;
    }

    /**
     * Busca com query customizada.
     */
    public function raw(string $sql, array $params = []): array
    {
        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Busca uma linha com query customizada.
     */
    public function rawOne(string $sql, array $params = []): ?array
    {
        return $this->db->fetch($sql, $params);
    }
}
