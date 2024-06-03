<div class="frame" id="createCampaignModal" style="display: none;">
    <div class="modal">
        <span class="title">Criar Nova Campanha</span>
        <form action="process_create_campaign.php" method="POST">
            <input type="text" name="titulo" placeholder="Título da Campanha" required>
            <input type="number" name="meta" placeholder="Meta de Arrecadação" required>
            <textarea name="descricao" placeholder="Descrição da Campanha" required></textarea>
            <button type="submit">Criar</button>
        </form>
        <div class="button" onclick="closeCreateCampaignModal()">Cancelar</div>
    </div>
</div>
