<?php

class Usuarios
{
    private $mysql;
    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function adicionarusuario(  string $Nome, string $Email, string $Statuss, string $Senha) : void 
    {
        $insereUsuario = $this->mysql->prepare('INSERT INTO usuarios ( Nome, Email, Statuss, Senha) VALUES(?,?,?,?);');
        $insereUsuario->bind_param('ssss', $Nome, $Email, $Statuss, $Senha);
        $insereUsuario->execute();
    }

    public function exibirTodos(): array
    {

        $resultado = $this->mysql->query("SELECT ID, Nome, Email FROM `usuarios` WHERE `Nome` != 'Admin' AND `Statuss` = '1'");   
             
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

        return $usuarios;

    }

    public function encontrarPorId(string $id): array
    {
        $selecionaUsuario = $this->mysql->prepare("SELECT id, Nome, Email, Statuss FROM usuarios WHERE id= ?");
        $selecionaUsuario->bind_param('s', $id);
        $selecionaUsuario->execute();
        $usuario = $selecionaUsuario->get_result()->fetch_assoc();
        return $usuario;
    }

    public function editar(string $id, string $Nome, string $Email): void 
    {
        $editaUsuario = $this->mysql->prepare('UPDATE usuarios SET Nome = ?, Email = ? WHERE id = ?');
        $editaUsuario->bind_param('sss', $Nome, $Email, $id);
        $editaUsuario->execute();
    }

    public function mudastatus(string $id, string $Statuss): void 
    {
        $mudastatusUsuario = $this->mysql->prepare('UPDATE usuarios SET Statuss = ? WHERE id = ?');
        $mudastatusUsuario->bind_param('ss', $Statuss, $id);
        $mudastatusUsuario->execute();
    }
    
}