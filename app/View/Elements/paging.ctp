<? $k = 5;   ?>
<div class="dataTables_paginate paging_bootstrap pagination">
        <ul>
                <li class="prev <?=($page == 1 ? 'disabled' : null)?>">
                        <a href="#"  data-page="<?=($page-1)?>">← Previous</a>
                </li>
                <? if(($page-$k) > 1) { ?>
                        <li class="active">
                                <a href="#">...</a>
                        </li>
                <? } ?>
                
                <? for($i=1; $i<=$total_pages; $i++) { ?>
                        <? if($i >= ($page-$k) && $i < ($page+$k)) { ?>
                                <li class="<?=($i == $page ? 'active' : NULL)?>">
                                        <a href="#" data-page="<?=$i?>"><?=$i?></a>
                                </li>
                        <? } ?>
                <? } ?>
                
                <? if(($page+$k) < $total_pages) { ?>
                        <li class="active">
                                <a href="#">...</a>
                        </li>
                <? } ?>
                <li class="next <?=($page == $total_pages ? 'disabled' : null)?>">
                        <a href="#" data-page="<?=($page+1)?>">Next → </a>
                </li>
        </ul>
</div>