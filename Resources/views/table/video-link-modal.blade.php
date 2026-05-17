<!-- Link til at åbne modal -->
<a href="#" data-bs-toggle="modal" data-bs-target="#videoModal{{ $video->id }}">
    Se video
</a>

<!-- Bootstrap Modal -->
<div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $video->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videoModalLabel{{ $video->id }}">{{ $video->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Luk"></button>
      </div>
      <div class="modal-body">
        <div class="ratio ratio-16x9">
          <iframe src="{{ $video->url }}" title="{{ $video->name }}" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
