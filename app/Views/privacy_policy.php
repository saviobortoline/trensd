<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
    .privacy-page {
        max-width: 1240px;
        margin: 0 auto;
        color: #1f2937;
    }

    .privacy-page h1 {
        font-size: clamp(2rem, 2.7vw, 3rem);
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    .privacy-page h2 {
        font-size: clamp(1.3rem, 1.8vw, 1.9rem);
        line-height: 1.25;
        margin: 1.2rem 0 0.65rem;
    }

    .privacy-page p {
        font-size: 1.06rem;
        line-height: 1.5;
        margin-bottom: 0.9rem;
        max-width: 1150px;
    }

    .privacy-page a {
        color: #d83030;
        text-decoration: none;
    }

    .privacy-page a:hover {
        text-decoration: underline;
    }
</style>

<article class="privacy-page">
    <h1>Política de Privacidade</h1>
    <p>Nosso endereço de site é: <a href="https://trensde.com.br" target="_blank" rel="noopener noreferrer">https://trensde.com.br</a>.</p>

    <h2>Comentários</h2>
    <p>
        Quando os visitantes deixam comentários no site, coletamos os dados mostrados no formulário de comentários, além do endereço IP do visitante e da string do agente do usuário do navegador para ajudar na detecção de spam.
    </p>
    <p>
        Uma sequência anonimizada criada a partir do seu endereço de e-mail (também chamada de hash) pode ser fornecida ao serviço Gravatar para ver se você está usando. A política de privacidade do serviço Gravatar está disponível aqui. Após a aprovação do seu comentário, sua foto de perfil será visível ao público no contexto do seu comentário.
    </p>

    <h2>Mídia</h2>
    <p>
        Se você enviar imagens para o site, evite enviar imagens com dados de localização incorporados (EXIF GPS). Os visitantes do site podem baixar e extrair quaisquer dados de localização das imagens no site.
    </p>

    <h2>Cookies</h2>
    <p>
        Se você deixar um comentário em nosso site, poderá optar por salvar seu nome, endereço de e-mail e site em cookies. Estes são para sua conveniência, para que você não precise preencher seus detalhes novamente quando deixar outro comentário. Esses cookies durarão um ano.
    </p>
    <p>
        Se você visitar nossa página de login, definiremos um cookie temporário para determinar se seu navegador aceita cookies. Este cookie não contém dados pessoais e é descartado quando você fecha o navegador.
    </p>
    <p>
        Ao fazer login, também configuraremos vários cookies para salvar suas informações de login e suas escolhas de exibição de tela. Os cookies de login duram dois dias e os cookies de opções de tela duram um ano. Se você selecionar “Lembrar de Mim”, seu login persistirá por duas semanas. Se você sair da sua conta, os cookies de login serão removidos.
    </p>
    <p>
        Se você editar ou publicar um artigo, um cookie adicional será salvo no seu navegador. Este cookie não contém dados pessoais e simplesmente indica o ID do post do artigo que você acabou de editar. Ele expira após 1 dia.
    </p>

    <h2>Conteúdo incorporado de outros sites</h2>
    <p>
        Os artigos neste site podem incluir conteúdo incorporado (por exemplo, vídeos, imagens, artigos, etc.). O conteúdo incorporado de outros sites se comporta da mesma maneira como se o visitante tivesse visitado o outro site.
    </p>
    <p>
        Esses sites podem coletar dados sobre você, usar cookies, incorporar rastreamento adicional de terceiros e monitorar sua interação com esse conteúdo incorporado, incluindo rastrear sua interação com o conteúdo incorporado se você tiver uma conta e estiver conectado a esse site.
    </p>

    <h2>Com quem compartilhamos seus dados</h2>
    <p>
        Se você solicitar uma redefinição de senha, seu endereço IP será incluído no e-mail de redefinição.
    </p>

    <h2>Por quanto tempo retemos seus dados</h2>
    <p>
        Se você deixar um comentário, o comentário e seus metadados serão retidos indefinidamente. Isso é para que possamos reconhecer e aprovar automaticamente quaisquer comentários de acompanhamento, em vez de retê-los em uma fila de moderação.
    </p>
    <p>
        Para usuários que se registram em nosso site (se houver), também armazenamos as informações pessoais que fornecem em seu perfil de usuário. Todos os usuários podem ver, editar ou excluir suas informações pessoais a qualquer momento (exceto que não podem alterar seu nome de usuário). Os administradores do site também podem ver e editar essas informações.
    </p>

    <h2>Quais são seus direitos sobre seus dados</h2>
    <p>
        Se você tiver uma conta neste site ou se tiver deixado comentários, pode solicitar um arquivo exportado dos dados pessoais que mantemos sobre você, incluindo quaisquer dados que você nos tenha fornecido. Você também pode solicitar que apaguemos qualquer dado pessoal que mantemos sobre você. Isso não inclui nenhum dado que somos obrigados a manter para fins administrativos, legais ou de segurança.
    </p>

    <h2>Para onde enviamos seus dados</h2>
    <p>
        Comentários de visitantes podem ser verificados por um serviço automatizado de detecção de spam.
    </p>
</article>
<?= $this->endSection() ?>
