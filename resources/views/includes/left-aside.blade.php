<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('lib/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
                <a href="#"><i class="fa fa-files-o fw"></i> <span>Arquivos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ Route('diario-de-classe') }}"><i class="fa fa-circle-o fw"></i> Gerar Diário de Classe</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Gerar Histórico Escolar</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Gerar Boletim</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Gerar Declaração</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-laptop fw"></i> <span>Administrativo</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ Route('professor') }}"><i class="fa fa-circle-o fw"></i> Professor</a></li>
                    <li><a href="{{ Route('aluno') }}"><i class="fa fa-circle-o fw"></i> Aluno</a></li>
                    <li><a href="{{ Route('funcionario') }}"><i class="fa fa-circle-o fw"></i> Funcionário</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Financeiro</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-university fw"></i> <span>Escola</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Materiais de Consumo</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Bens Patrimoniais</a></li>
                    <li><a href="{{ Route('cargo') }}"><i class="fa fa-circle-o fw"></i> Cargos e Funções</a></li>
                    <li><a href="{{ Route('fornecedor') }}"><i class="fa fa-circle-o fw"></i> Fornecedor</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#"><i class="fa fa-users fw"></i> <span>Pedagógico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ Route('turma') }}"><i class="fa fa-circle-o fw"></i> Turma</a></li>
                    <li><a href="{{ Route('disciplina') }}"><i class="fa fa-circle-o fw"></i> Cadastrar/Alterar Disciplina</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o fw"></i> <span>Aluno</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o fw"></i> Lançar Nota</a></li>
                            <li><a href="#"><i class="fa fa-circle-o fw"></i> Lançar Frequência</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-bar-chart-o fw"></i> <span>Relatórios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Relatórios de Alunos</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Relatórios de Professores</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Relatórios de Funcionários</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Relatórios de Fornecedores</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Relatórios Financeiros</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-cog fw"></i> <span>Opções</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Suporte</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Log do Sistema</a></li>
                    <li><a href="#"><i class="fa fa-circle-o fw"></i> Consultar Contrato</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>