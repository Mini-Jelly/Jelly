<nav id="nav" class="nav">
  <div class="nav-content">
    <a class="nav-logo" href="<?php $this->options->siteUrl(); ?>">
      <img src="<?php if ($this->options->logoUrl):
        $this->options->logoUrl();
      else:
        $this->options->themeUrl('assets/img/logo/logo.webp');
      endif; ?>" alt="<?php $this->options->title() ?>" />
    </a>
    <?php
    $this->widget('Widget_Metas_Category_List')->to($category); ?>
    <ul class="nav-list">
      <!-- levels===0时防止循环子类造成重复-->
      <?php while ($category->next()): ?>
        <?php if ($category->levels === 0): ?>
          <?php $children = $category->getAllChildren($category->mid); ?>
          <li>
            <a href="<?= $category->permalink(); ?>" title="<?= $category->name(); ?>">
              <?= $category->name(); ?>
            </a>
          </li>
          <?php foreach ($children as $mid):
            $child = $category->getCategory($mid); ?>
            <li>
              <a href="<?= $child['permalink'] ?>" title="<?= $child['name']; ?>">
                <?= $child['name']; ?>
              </a>
            </li>
          <?php endforeach; endif; endwhile; ?>
    </ul>
    <button class="nav-form-open-button" id="nav-form-open-button" aria-label="open-form">
      <svg x="1687783407648" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M950.071755 908.285558 706.231191 664.444994c53.31323-63.253626 85.541235-144.807037 85.541235-234.007615 0-200.797235-162.77834-363.575576-363.575576-363.575576S64.621275 229.640144 64.621275 430.437379c0 200.797235 162.77834 363.575576 363.575576 363.575576 91.494831 0 174.795025-34.031071 238.705614-89.802282l243.621577 243.621577c11.79872 11.79872 30.15274 12.45466 41.077557 1.529843C962.525392 938.437276 961.870476 920.083256 950.071755 908.285558zM120.556215 430.437379c0-169.661098 138.033773-307.640636 307.640636-307.640636 169.661098 0 307.640636 137.979538 307.640636 307.640636 0 169.661098-137.979538 307.640636-307.640636 307.640636C258.589988 738.078015 120.556215 600.098477 120.556215 430.437379z"
          fill="#ffffff">
        </path>
      </svg>
    </button>
    <form class="nav-form" method="post" action="<?php $this->options->siteUrl(); ?>">
      <button class="nav-form-submit" aria-label="Submit" type="submit">
        <svg x="1687783407648" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="20" height="44">
          <path
            d="M950.071755 908.285558 706.231191 664.444994c53.31323-63.253626 85.541235-144.807037 85.541235-234.007615 0-200.797235-162.77834-363.575576-363.575576-363.575576S64.621275 229.640144 64.621275 430.437379c0 200.797235 162.77834 363.575576 363.575576 363.575576 91.494831 0 174.795025-34.031071 238.705614-89.802282l243.621577 243.621577c11.79872 11.79872 30.15274 12.45466 41.077557 1.529843C962.525392 938.437276 961.870476 920.083256 950.071755 908.285558zM120.556215 430.437379c0-169.661098 138.033773-307.640636 307.640636-307.640636 169.661098 0 307.640636 137.979538 307.640636 307.640636 0 169.661098-137.979538 307.640636-307.640636 307.640636C258.589988 738.078015 120.556215 600.098477 120.556215 430.437379z"
            fill="#ffffff">
          </path>
        </svg>
      </button>
      <input name="s" class="nav-form-input" id="nav-form-input" placeholder="Search" autocomplete="off" type="text">
      <button id="nav-form-close-button" class="nav-form-close-button" type="button">
        <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="22" height="44">
          <path d="M872.802928 755.99406 872.864326 755.99406 872.864326 755.624646Z" fill="#bfbfbf">
          </path>
          <path
            d="M927.846568 511.997953c0-229.315756-186.567139-415.839917-415.838893-415.839917-229.329059 0-415.85322 186.524161-415.85322 415.839917 0 229.300406 186.524161 415.84094 415.85322 415.84094C741.278405 927.838893 927.846568 741.29836 927.846568 511.997953M512.007675 868.171955c-196.375529 0-356.172979-159.827125-356.172979-356.174002 0-196.374506 159.797449-356.157629 356.172979-356.157629 196.34483 0 356.144326 159.783123 356.144326 356.157629C868.152001 708.34483 708.352505 868.171955 512.007675 868.171955"
            fill="#bfbfbf"></path>
          <path
            d="M682.378947 642.227993 553.797453 513.264806 682.261267 386.229528c11.661597-11.514241 11.749602-30.332842 0.234337-41.995463-11.514241-11.676947-30.362518-11.765975-42.026162-0.222057L511.888971 471.195665 385.223107 344.130711c-11.602246-11.603269-30.393217-11.661597-42.025139-0.059352-11.603269 11.618619-11.603269 30.407544-0.059352 42.011836l126.518508 126.887922L342.137823 639.104863c-11.662621 11.543917-11.780301 30.305213-0.23536 41.96988 5.830799 5.89015 13.429871 8.833179 21.086248 8.833179 7.53972 0 15.136745-2.8847 20.910239-8.569166l127.695311-126.311801L640.293433 684.195827c5.802146 5.8001 13.428847 8.717546 21.056572 8.717546 7.599072 0 15.165398-2.917446 20.968567-8.659217C693.922864 672.681586 693.950494 653.889591 682.378947 642.227993"
            fill="#bfbfbf"></path>
        </svg>
      </button>
    </form>
  </div>
</nav>

<nav id="mnav" class="mnav">
  <div class="mnav-menu-trigger">
    <button id="mnav-menu-trigger-button" class="mnav-menu-trigger-button" aria-label="mnav-menu-trigger-button"
      role="button">
      <svg width="18" height="18" viewBox="0 0 18 18">
        <polyline id="mnav-menu-trigger-bread-bottom" class="mnav-menu-trigger-bread mnav-menu-trigger-bread-bottom"
          fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"
          points="2 12, 16 12">
          <animate id="mnav-anim-menu-trigger-bread-bottom-open" attributeName="points" keyTimes="0;0.5;1" dur="0.24s"
            begin="indefinite" fill="freeze" calcMode="spline" keySplines="0.42, 0, 1, 1;0, 0, 0.58, 1"
            values=" 2 12, 16 12; 2 9, 16 9; 3.5 15, 15 3.5">
          </animate>
          <animate id="mnav-anim-menu-trigger-bread-bottom-close" attributeName="points" keyTimes="0;0.5;1" dur="0.24s"
            begin="indefinite" fill="freeze" calcMode="spline" keySplines="0.42, 0, 1, 1;0, 0, 0.58, 1"
            values=" 3.5 15, 15 3.5; 2 9, 16 9; 2 12, 16 12">
          </animate>
        </polyline>
        <polyline id="mnav-menu-trigger-bread-top" class="mnav-menu-trigger-bread mnav-menu-trigger-bread-top" fill="none"
          stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" points="2 5, 16 5">
          <animate id="mnav-anim-menu-trigger-bread-top-open" attributeName="points" keyTimes="0;0.5;1" dur="0.24s"
            begin="indefinite" fill="freeze" calcMode="spline" keySplines="0.42, 0, 1, 1;0, 0, 0.58, 1"
            values=" 2 5, 16 5; 2 9, 16 9; 3.5 3.5, 15 15">
          </animate>
          <animate id="mnav-anim-menu-trigger-bread-top-close" attributeName="points" keyTimes="0;0.5;1" dur="0.24s"
            begin="indefinite" fill="freeze" calcMode="spline" keySplines="0.42, 0, 1, 1;0, 0, 0.58, 1"
            values=" 3.5 3.5, 15 15; 2 9, 16 9; 2 5, 16 5">
          </animate>
        </polyline>
      </svg>
    </button>
  </div>
  <div class="mnav-content">
    <a class="mnav-logo" href="<?php $this->options->siteUrl(); ?>">
      <img src="<?php if ($this->options->logoUrl):
        $this->options->logoUrl();
      else:
        $this->options->themeUrl('assets/img/logo/logo.webp');
      endif; ?>" alt="<?php $this->options->title() ?>" />
    </a>
    <form class="mnav-form" method="post" action="<?php $this->options->siteUrl(); ?>">
      <button class="mnav-form-search" aria-label="search-button" type="submit">
        <svg x="1687783407648" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
          <path
            d="M950.071755 908.285558 706.231191 664.444994c53.31323-63.253626 85.541235-144.807037 85.541235-234.007615 0-200.797235-162.77834-363.575576-363.575576-363.575576S64.621275 229.640144 64.621275 430.437379c0 200.797235 162.77834 363.575576 363.575576 363.575576 91.494831 0 174.795025-34.031071 238.705614-89.802282l243.621577 243.621577c11.79872 11.79872 30.15274 12.45466 41.077557 1.529843C962.525392 938.437276 961.870476 920.083256 950.071755 908.285558zM120.556215 430.437379c0-169.661098 138.033773-307.640636 307.640636-307.640636 169.661098 0 307.640636 137.979538 307.640636 307.640636 0 169.661098-137.979538 307.640636-307.640636 307.640636C258.589988 738.078015 120.556215 600.098477 120.556215 430.437379z"
            fill="#ffffff">
          </path>
        </svg>
      </button>
      <input name="s" class="mnav-form-input" id="mnav-form-input" placeholder="Search" autocomplete="off" type="text">
    </form>
    <?php
    $this->widget('Widget_Metas_Category_List')->to($category); ?>
    <ul class="mnav-list">
      <!-- levels===0时防止循环子类造成重复-->
      <?php while ($category->next()): ?>
        <?php if ($category->levels === 0): ?>
          <?php $children = $category->getAllChildren($category->mid); ?>
          <li>
            <a href="<?= $category->permalink(); ?>" title="<?= $category->name(); ?>">
              <?= $category->name(); ?>
            </a>
          </li>
          <?php foreach ($children as $mid):
            $child = $category->getCategory($mid); ?>
            <li>
              <a href="<?= $child['permalink'] ?>" title="<?= $child['name']; ?>">
                <?= $child['name']; ?>
              </a>
            </li>
          <?php endforeach; endif; endwhile; ?>
    </ul>
  </div>
</nav>