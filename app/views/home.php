<div class="container p-3">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= URL; ?>public/assets/img/logo.webp" alt="" width="80" height="80" class="d-inline-block align-text-top">
                <div class="d-flex flex-column ms-3">
                    <strong>Metendo a Colher</strong>
                    <small class="m-0" style="font-size: 0.8rem;">Conselhos Matrimoniais</small>
                </div>
            </a>
        </div>
    </nav>

    <div class="description mt-3" style="font-size: 1rem;">
        <p>Seja bem vindo!</p>
        <p>Utilizamos inteligência artifical para dar conselhos matrimoniais e uma sugestão de carta para ser enviada para o seu cônjuge. <br> Melhore seu relacionamento com ajuda de inteligência artifical.</p>
        <p>Preencha o formulário abaixo e clique Enviar para ver o resultado.</p>
        <p>Experimente gratuitamente!</p>
        <p class="fw-bold text-danger" style="font-size: 0.8rem;">Não se preocupe, este site não usa cookies nem armazena nenhum dado ou informação do usuário. <br>
            Todas as informações coletadas são utilizadas somente para gerar os resultados necessários e descartadas em seguida.</p>
    </div>

    <hr>

    <?php if (empty($success)) : ?>

        <div class="row visually-hidden" id="spinner">
            <div class="col-sm text-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <form method="post" class="mt-3 needs-validation" id="form" novalidate>
            <div class="row">
                <div class="col-sm form-group">
                    <label for="yourname" class="form-label">1. Seu nome:</label>
                    <input type="text" class="form-control" name="yourname" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório.
                    </div>
                </div>
                <div class="col-sm-2 form-group">
                    <label for="yourage" class="form-label">2. Sua idade:</label>
                    <input type="number" class="form-control" name="yourage" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório.
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <label for="yourjob" class="form-label">3. Seu trabalho:</label>
                    <input type="text" class="form-control" name="yourjob" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm form-group">
                    <label for="spousername" class="form-label">4. Nome do cônjuge:</label>
                    <input type="text" class="form-control" name="spousername" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório.
                    </div>
                </div>
                <div class="col-sm-2 form-group">
                    <label for="spouserage" class="form-label">5. Idade do cônjuge:</label>
                    <input type="number" class="form-control" name="spouserage" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório.
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <label for="spouserjob" class="form-label">6. Trabalho do cônjuge:</label>
                    <input type="text" class="form-control" name="spouserjob" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 form-group">
                    <label for="agemarried" class="form-label">7. Anos de relacionamento: <br> <small>(Em anos)</small></label>
                    <input type="number" name="agemarried" class="form-control" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório.
                    </div>
                </div>
                <div class="col-sm form-group">
                    <label for="focus" class="form-label">8. Pra você, quais são os objetivos do casamento <br> <small>(Até 5
                            palavras)</small></label>
                    <input type="text" name="focus" class="form-control" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório. Escreva pelo menos 1 palavra.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label for="mainproblem" class="form-label">9. Discriminação do problema <br> <small>(Quanto mais
                            informações e mais precisas forem, serão o diagnóstico
                            e as sugestões da Inteligência Artifical)</small></label>
                    <textarea name="mainproblem" id="mainproblem" class="form-control" rows="5" required></textarea>
                    <div class="invalid-feedback">
                        Campo Obrigatório.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label for="one" class="form-label">10. Se você fosse resumir todos os problemas do seu relacionamento
                        em até 5 palavras, quais palavras você usaria? <small>(Até 5
                            palavras)</small></label>
                    <input type="text" name="one" id="one" class="form-control" required>
                    <div class="invalid-feedback">
                        Campo Obrigatório. Escreva pelo menos 1 palavra.
                    </div>
                </div>
                <div class="col-sm">
                    <div class="col-sm form-group">
                        <label for="obs" class="form-label">11. Alguma outra informação importante?<br> <small>(Se
                                tiver, altere o texto abaixo)</small></label>
                        <textarea name="obs" id="obs" class="form-control" rows="3">Não existem outras informações importantes. Tudo já foi dito anteriormente.</textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3" name="action" value="consultar" id="btn-enviar">Enviar</button>


        </form>
    <?php else : ?>

        <p class="show-content">
            <a href="<?php URL; ?>">Voltar</a>
            <hr>
            <?= $success ?>
            <hr>
        <p>Inteligência Artifical pode cometer erros. Considere verificar informações importantes.</p>
        <a href="<?php URL; ?>">Voltar</a>
        </p>

    <?php endif; ?>
</div>