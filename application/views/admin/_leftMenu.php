<div class="vertical-menu">
   <div data-simplebar class="h-100">
      <div id="sidebar-menu">
         <ul class="metismenu list-unstyled" id="side-menu">
            <?php if (!empty($menu)) foreach ($menu as $key => $item) : ?>
               <?php if (!empty($item->child)) : ?>
                  <li class="menu-title" key="t-menu"><?php echo $item->title; ?></li>
                  <?php foreach ($item->child as $ckey => $citem) : ?>
                     <?php if (!empty($citem->child)) : ?>
                        <li><a href="javascript: void(0);" class="has-arrow waves-effect">
                              <?php echo $citem->icon; ?>
                              <span key="t-layouts">
                                 <?php echo $citem->title; ?>
                              </span>
                           </a>
                           <ul class="sub-menu" aria-expanded="true">
                              <?php foreach ($citem->child as $pkey => $pitem) : ?>
                                 <li>
                                    <a href="<?php echo base_url($pitem->url); ?>" class="waves-effect">
                                       <?php echo $pitem->icon; ?>
                                       <span key="t-dashboards"><?php echo $pitem->title; ?></span>
                                    </a>
                                 </li>
                              <?php endforeach; ?>
                           </ul>
                        </li>
                     <?php else : ?>
                        <li>
                           <a href="<?php echo base_url($citem->url); ?>" class="waves-effect">
                              <?php echo $citem->icon; ?>
                              <span key="t-layouts">
                                 <?php echo $citem->title; ?>
                              </span>
                           </a>
                        </li>
                     <?php endif; ?>
                  <?php endforeach; ?>
               <?php else : ?>
                  <li>
                     <a href="<?php echo base_url($item->url); ?>" class="waves-effect">
                        <?php echo $item->icon; ?>
                        <span key="t-layouts">
                           <?php echo $item->title; ?>
                        </span>
                     </a>
                  </li>
               <?php endif; ?>
            <?php endforeach; ?>
         </ul>
      </div>
   </div>
</div>