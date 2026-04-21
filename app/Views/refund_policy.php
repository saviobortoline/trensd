<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
    .policy-page {
        max-width: 1240px;
        margin: 0 auto;
        color: #1f2937;
    }

    .policy-page h1 {
        font-size: clamp(2rem, 2.7vw, 3rem);
        line-height: 1.1;
        margin-bottom: 1.3rem;
    }

    .policy-page h2 {
        font-size: clamp(1.65rem, 2vw, 2.2rem);
        line-height: 1.2;
        margin: 1.35rem 0 0.75rem;
    }

    .policy-page p {
        font-size: 1.08rem;
        line-height: 1.5;
        margin-bottom: 0.95rem;
        max-width: 1150px;
    }
</style>

<article class="policy-page">
    <h1>Política de Reembolso, Devolução e Troca</h1>

    <h2>Reembolso</h2>
    <p>
        Nosso compromisso é com a sua satisfação. Se você não estiver completamente satisfeito com sua compra, você tem o
        direito de solicitar um reembolso dentro do prazo estabelecido por lei.
    </p>
    <p>
        Para solicitar um reembolso, entre em contato conosco informando os detalhes da compra e o motivo do reembolso.
        Faremos uma análise do caso e, se o reembolso for aprovado, o valor será estornado de acordo com o método de
        pagamento original.
    </p>

    <h2>Devolução</h2>
    <p>
        Caso o produto recebido apresente defeitos de fabricação ou não esteja de acordo com o que foi especificado na
        compra, você tem o direito de solicitar a devolução do produto.
    </p>
    <p>
        Para iniciar o processo de devolução, entre em contato conosco informando os detalhes da compra, incluindo fotos do
        produto defeituoso, se aplicável. Faremos uma análise do caso e, se a devolução for aprovada, forneceremos
        instruções sobre como proceder com o retorno do produto.
    </p>
    <p>
        Após recebermos o produto devolvido, faremos uma avaliação para confirmar o defeito ou a não conformidade. Se o
        retorno for validado, providenciaremos o reembolso ou a troca do produto, conforme sua preferência.
    </p>

    <h2>Troca</h2>
    <p>
        Se você recebeu um produto com defeito ou que não corresponde ao que foi solicitado, você tem o direito de
        solicitar a troca por um produto equivalente ou o reembolso do valor pago.
    </p>
    <p>
        Para solicitar uma troca, entre em contato conosco informando os detalhes da compra e o motivo da troca. Faremos
        uma análise do caso e, se a troca for aprovada, forneceremos instruções sobre como proceder com o retorno do
        produto.
    </p>
    <p>
        Após recebermos o produto devolvido, faremos uma avaliação para confirmar o defeito ou a não conformidade. Se o
        retorno for validado, providenciaremos a troca pelo produto desejado ou o reembolso do valor pago.
    </p>

    <h2>Considerações Gerais</h2>
    <p>
        É importante ressaltar que o direito de reembolso, devolução e troca está sujeito às condições estabelecidas pelo
        Código de Defesa do Consumidor. Nos reservamos o direito de recusar solicitações que não atendam aos requisitos
        legais.
    </p>
    <p>
        Para garantir uma experiência satisfatória de compra, recomendamos que verifique cuidadosamente as especificações do
        produto antes de efetuar a compra e entre em contato conosco caso tenha alguma dúvida ou necessidade de
        esclarecimento.
    </p>
</article>
<?= $this->endSection() ?>
