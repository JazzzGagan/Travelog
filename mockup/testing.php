<?php
$is_invalid = false;
if($_SERVER['REQUEST_METHOD']=== "POST"){
    $mysqli = require __DIR__. "/dbconnect.php";

    $sql = sprintf("SELECT * FROM users
                where email = '%s'",
                $mysqli->real_escape_string( $_POST["email"])); $result =
$mysqli->query($sql); $user = $result->fetch_assoc(); if($user){
if(password_verify($_POST["password"], $user["password_hash"])){
session_start(); session_regenerate_id(); $_SESSION["user_id"] = $user["id"];
header("Location: index.php"); exit; } } $is_invalid = true; } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Travelog</title>
    <link
      rel="icon"
      href="./Images/icon.png"
      sizes="46x46"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="testing.css" type="text/css" />
    <script
      src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"
      defer
    ></script>
    <script src="./js/validation.js" defer></script>
  </head>
  <body>
    <header>
      <div class="nav-bar">
        <div class="nav-container">
          <div class="logo"></div>

          <div class="nav-content">
            <a href="AboutTravelog.html" target="_blank">Our Story</a>
            <a href="#">Booking</a>
            <!-- <a href="#">Sign in</a> -->

            <!--  <button class="getstarted">Get Started</button> -->
            <div class="signin-signup">
              <button class="signin">Sign in</button>
              <button class="signup">Sign up</button>
            </div>
          </div>
        </div>
      </div>
    </header>
    <section>
      <div class="hero-section">
        <div class="hero-message">
          <h2>Stay Curious.</h2>
          <div class="message">
            <span>
              <p>
                Create your own travel diary to capture and share your travel
                experiences!
              </p>
            </span>
          </div>
          <!-- <button class="btn2">Start Reading</button> -->
        </div>
      </div>
    </section>

    <div class="blur-background"></div>
    <div class="form-popup">
      <div class="login e-none">
        <div class="close-button"><i class="fa-solid fa-xmark"></i></div>
        <div class="travelog-logo"></div>
        <div class="welcome">
          <h1>Welcome to Travelog</h1>
        </div>
        <div class="form-cotainer">
          <?php if($is_invalid): ?>
          <em>Invalid Login</em>
          <?php endif; ?>

          <form id="form-register" method="POST" novalidate>
            <div class="email">
              <label for="email"> Email </label>
            </div>
            <span>
              <div class="email-container">
                <input type="email" id="email" name="email" autocomplete="email"
                placeholder="Email" spellcheck="false" value="<?= htmlspecialchars($_POST["email"] ?? "")?>">
              </div>
            </span>
            <br />

            <div class="password">
              <label for="password"> Password </label>
            </div>
            <span>
              <div class="pass-container">
                <input
                  class="password-input"
                  type="password"
                  id="password"
                  name="password"
                  autocomplete="list"
                  placeholder="Password"
                  spellcheck="false"
                />
                <span class="eye" onclick="passwordVisibile()">
                  <i id="icon1" class="fa-solid fa-eye"></i>
                  <i id="icon2" class="fa-solid fa-eye-slash"></i>
                </span>
              </div>
            </span>

            <div class="submit-button">
              <!--  <button class="btn btn-primary"> Log in</button> -->
              <input
                type="submit"
                class="btn btn-primary"
                name="submit"
                value="Log in"
              />
            </div>

            <div class="signup-button">
              <button class="login-signup" type="button">
                Not on Travelog? Signup
              </button>
            </div>
          </form>
        </div>
      </div>

      <!--   signup -->

      <div class="signup-form d-none">
        <div class="close-singup"><i class="fa-solid fa-xmark"></i></div>
        <div class="travelog-logo"></div>
        <div class="welcome">
          <h1>Join Travelog</h1>
        </div>

        <div class="form-cotainer">
          <form id="formregister" action="signup.php" method="POST" novalidate>
            <div class="username">
              <label for="name">FullName</label>
            </div>
            <div class="username-container">
              <input
                class="username-input"
                type="text"
                id="username"
                name="name"
                placeholder="Fullname"
              />
            </div>
            <div class="email-signup">
              <label for="email"> Email </label>
            </div>
            <span>
              <div class="email-signup-container">
                <input
                  type="email"
                  id="email"
                  name="email"
                  autocomplete="email"
                  placeholder="Email"
                  spellcheck="false"
                />
              </div>
            </span>
            <br />

            <div class="password-signup">
              <label for="password"> Password </label>
            </div>
            <span>
              <div class="pass-signup-container">
                <input
                  class="password-input"
                  type="password"
                  id="password"
                  name="password"
                  autocomplete="list"
                  placeholder="Password"
                  spellcheck="false"
                />
                <span class="eye1" onclick="signupPasswordVisible()">
                  <i id="icon3" class="fa-solid fa-eye"></i>
                  <i id="icon4" class="fa-solid fa-eye-slash"></i>
                </span>
              </div>
            </span>

            <br />
            <!--  <div class="dob">
              <label for="dob">Date of Birth</label>
            </div>
            <div class="dob-container">
              <input
                class="dob-input"
                type="date"
                id="dob"
                name="dob"
                pattern="\d{1,2}/\d{1,2}/\d{4}"
                placeholder="dd/mm/yyyy"
                required
              />
            </div> -->

            <div class="submit-button-signup">
              <input type="submit" class="btn-continue" value="Continue" />
            </div>

            <div class="already-account">
              <div class="already">Already a Member?</div>
              <button class="already-button" type="button">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Et iusto harum
      voluptates dolorem hic ex labore alias commodi, sequi odio modi!
      Voluptate, excepturi pariatur deleniti accusantium voluptates fugiat
      consequatur nemo! Pariatur sequi, vitae aspernatur tenetur iusto natus,
      ipsa at, maxime delectus perspiciatis ipsam explicabo quae aliquam eius.
      Velit obcaecati, cupiditate beatae dolore atque illo maxime tenetur dolor
      eum enim! Et? Neque ipsa dolores repellat dicta natus placeat temporibus
      omnis sunt, iste sint quas eligendi, esse, ducimus cum fugit adipisci
      voluptatum voluptatem rem inventore magnam quo assumenda! Esse ea porro
      cum! Eius adipisci beatae minima vitae perferendis officiis eveniet
      laudantium soluta obcaecati amet esse praesentium eligendi, accusamus
      asperiores nesciunt tempore odio ut eos tenetur consequuntur sit natus!
      Esse officia omnis beatae! Ducimus impedit et atque perspiciatis ratione
      facere rerum aut consequatur maxime doloremque! Enim voluptate, nobis
      fugit corporis doloribus quos quibusdam quas libero, sequi repellendus,
      tempora possimus? Quisquam repellat est omnis! Iure ea, soluta culpa odio
      delectus corporis perspiciatis. Reprehenderit est quaerat cumque id optio
      libero error fuga recusandae ullam repudiandae nostrum, sunt saepe?
      Voluptas a officiis odit, corrupti tempore at. Nihil modi consequuntur
      fugit pariatur sunt suscipit at repellendus, quo, nulla ducimus, doloribus
      accusamus vero est cumque non! Omnis tempore molestias modi sit! In quo at
      obcaecati consequatur iure odit. Aliquam, odit minima perferendis
      accusantium praesentium itaque reiciendis totam suscipit rerum commodi
      odio at sit excepturi atque consequatur, aut eaque? Hic et ut, sequi
      reprehenderit ipsa recusandae libero incidunt ex. Voluptate eum,
      laudantium ex quisquam commodi, ab quos eius soluta culpa unde, pariatur
      eveniet deserunt delectus iure. Nam, sit id architecto et sunt,
      repudiandae culpa, officia nisi odio optio ipsa. Maiores laboriosam
      officiis possimus repudiandae! Expedita cupiditate eveniet doloremque
      neque doloribus officiis dolorem earum ut facere, nemo delectus,
      asperiores quaerat, atque dolore maxime! Veniam mollitia aspernatur
      provident, accusamus tenetur tempora. Cum, perferendis! Veniam voluptas
      doloremque assumenda quo placeat ratione hic consectetur dignissimos
      tenetur maxime dolore delectus, nemo accusantium nobis sequi at. In
      laborum consequatur provident est quod sequi, cumque soluta! Praesentium
      facere cum beatae dicta voluptatibus neque excepturi rerum, quia ipsam
      iste ea accusamus labore explicabo sunt, nihil unde laudantium non nemo et
      nostrum. Commodi dolorum voluptate porro distinctio cumque. Praesentium
      quis, corrupti itaque expedita modi nobis id dolores delectus excepturi
      incidunt perferendis molestias iusto odio ratione temporibus illum eos,
      esse magnam impedit molestiae! Illo, doloremque! Nemo perspiciatis
      voluptates ipsum. Iure nostrum recusandae qui eligendi adipisci
      accusantium necessitatibus sunt eaque tenetur quas ducimus nam, accusamus
      minus distinctio tempora ex consequuntur, sint dolorem quidem laudantium!
      Ad enim eveniet quos laboriosam id. Officiis ipsam quibusdam, hic dolorem
      delectus nam eos. Sint necessitatibus dicta aperiam modi cumque ipsa
      excepturi, commodi aliquid non quos, tenetur error numquam perspiciatis?
      Officia omnis molestiae quod. Earum, inventore! Soluta, vero in similique
      cum suscipit dolorem repudiandae rem, quisquam molestias aperiam earum
      porro corrupti! Mollitia amet id officia adipisci, unde fugit tempore eum
      veritatis ratione tenetur minus saepe eius. Odio pariatur soluta
      exercitationem, veniam sit quis iure praesentium error, molestias debitis
      ab ex ullam recusandae sunt, sed eligendi velit consequuntur facilis est
      neque quod quas commodi ipsam earum. Amet. Sapiente aspernatur nihil ipsa
      esse dicta natus itaque praesentium unde velit! Quisquam ipsam, et sequi
      eos est quo, necessitatibus veniam error cumque itaque hic voluptate,
      suscipit optio enim consequatur cupiditate? Molestiae at ad accusamus
      officiis voluptatum, nulla illo et repellat delectus provident? Dolores
      non aut ea minus, esse tenetur quod labore itaque dolorum provident
      quidem, eligendi qui numquam animi quasi! Consectetur odit, quod non
      eligendi incidunt ipsum molestias atque, voluptate facere at ad est!
      Quidem a alias facere nisi temporibus natus rem? Assumenda voluptatibus
      hic in quibusdam quod corporis aut! Eligendi ad ratione odio libero
      similique nam? Sed temporibus perspiciatis beatae unde quos fugiat!
      Expedita quidem optio quis itaque nesciunt laboriosam, cum maiores
      reiciendis, quod blanditiis numquam voluptates magni illo? Praesentium
      saepe inventore, repellat sit tempora corrupti earum excepturi, nisi rem
      autem reiciendis dolor a voluptas optio. Ab, aliquid? Quod voluptatum,
      asperiores necessitatibus ab vitae maiores est blanditiis facere nostrum!
      Natus iste quia quas expedita enim. Eius veritatis modi esse rem vero
      veniam quaerat quibusdam laborum illo, ex nihil quas ipsam quasi possimus
      cum vitae velit aliquam? Quidem, dicta beatae! Corporis, iure quos ea,
      officia nobis ipsa eligendi nulla quidem asperiores explicabo recusandae
      delectus tempore incidunt expedita quibusdam illum quis. Tempore ex at nam
      blanditiis in, delectus magnam possimus laboriosam! Asperiores ex nisi vel
      fuga rerum ipsa obcaecati amet aperiam sunt praesentium officiis dolores,
      iusto quaerat laudantium delectus expedita enim doloremque autem illo
      inventore tempora accusantium accusamus at commodi. Quia. Dolore officiis
      minus quibusdam nostrum, blanditiis odio beatae libero doloremque cum
      consectetur! Velit in eius ipsa harum magnam earum illum voluptatem minus
      nesciunt officiis at voluptatibus, voluptates dolorem numquam vel! Earum
      ex maxime deleniti quibusdam nobis, laborum molestiae nesciunt doloremque
      natus aliquam, magni quisquam reiciendis doloribus ipsa, voluptas hic ab
      numquam impedit quasi ea omnis facilis eum. Hic, velit alias.
      Necessitatibus aliquid cumque inventore quisquam minus eum, at soluta
      maiores quaerat odio quia doloribus tempora incidunt tempore totam omnis!
      Distinctio ullam ratione repellat ut suscipit aut odit eos vero. Mollitia?
      Non consequuntur alias iure? Mollitia, debitis omnis odit, repudiandae
      ullam quibusdam repellendus eum, voluptatibus dolor sapiente laudantium
      recusandae nobis quasi cum repellat. Sunt veritatis repellendus quam
      fugiat. Accusantium, rem id! Dignissimos laborum iste placeat tempore
      assumenda cupiditate reprehenderit cum quo voluptatem dolorum vel esse
      excepturi, veritatis, sint aut nostrum voluptatum ullam. Corporis quia
      ducimus quisquam magni, temporibus hic praesentium quo! Natus quidem
      excepturi amet, repudiandae eos adipisci! Excepturi voluptatum laborum eum
      libero iste dignissimos doloribus quae repudiandae delectus officiis
      dolore, pariatur error laboriosam repellat. Atque unde odit incidunt
      voluptatem quaerat? Iusto voluptatem exercitationem quae rem laboriosam
      quis similique accusantium quidem unde rerum at perferendis, eveniet
      impedit voluptatum, doloremque mollitia tempora reiciendis vero id tenetur
      enim. Obcaecati praesentium quisquam officia repellendus! Inventore
      debitis corporis laudantium repellat voluptatum adipisci aperiam aliquam
      autem, molestias eligendi deleniti maiores magnam nulla ea. Labore quam
      autem expedita eaque nesciunt? Consectetur est modi minus praesentium nam
      et? Soluta iusto cumque sapiente suscipit sit amet qui, dolorum sed vitae
      tenetur deleniti expedita? Consectetur consequuntur, dolores odit quo
      sequi blanditiis aperiam inventore aliquam praesentium veniam impedit
      porro, consequatur cum! Soluta necessitatibus alias corrupti perspiciatis
      ab excepturi consectetur. Molestiae maxime, provident delectus debitis
      repudiandae a accusamus, excepturi non illum labore veniam sit alias
      possimus repellat consequuntur tempore ex distinctio mollitia! Aut,
      distinctio quasi fugit sequi odit unde voluptate reiciendis consequuntur!
      Est incidunt neque veniam cumque? Iusto quaerat velit architecto, commodi
      eos ipsam, natus alias odit at deleniti tempore. Sint, eos! Ratione eius
      recusandae, ipsum laborum aliquam placeat sed ex officiis cupiditate quae
      culpa repellendus ullam beatae, sequi illo officia voluptatibus suscipit
      autem voluptates? Vero rem eum maxime? Iusto, a fugit. Cum vero ut neque
      eveniet ad, enim ea ratione dicta nihil necessitatibus sed temporibus
      optio dolorem exercitationem doloremque tempore ipsam aliquam impedit
      dolores recusandae nostrum? Ipsa debitis similique at aspernatur. Dolorem
      praesentium excepturi aliquid, placeat nobis iste neque explicabo
      temporibus quisquam eligendi reprehenderit officiis eos nesciunt
      exercitationem perspiciatis aut deleniti sapiente! Veniam nam quia aperiam
      qui dignissimos voluptatibus quasi esse! Expedita amet illum iusto sunt
      eveniet dolorum provident sint! Autem quae odio dolorum asperiores ad fuga
      maxime. Ab ducimus quisquam accusantium perferendis maxime deserunt
      voluptatem dolor odit? Dicta, exercitationem sint! Nobis labore dicta
      ipsam ratione cumque fugiat distinctio ex ipsa aut rerum, porro laudantium
      excepturi voluptas illo enim reiciendis numquam hic ducimus sapiente
      libero, qui tenetur dolor quasi. Maiores, aliquam. Quae corrupti quam iure
      deleniti, fuga praesentium iusto exercitationem unde hic sit excepturi
      neque amet possimus voluptatem aliquid tempore porro consequuntur fugiat!
      Natus animi laboriosam saepe ullam perferendis quis adipisci. Natus ex
      dolores molestias nulla quisquam, veniam, sapiente quis optio odit ea
      adipisci quo reprehenderit maxime accusantium? Animi aliquid labore
      repellendus laboriosam dolorum quo, corporis asperiores nemo, placeat
      commodi nisi? Alias cum enim eos ex laudantium voluptas adipisci, odio
      aliquid consequuntur ab, obcaecati labore exercitationem dolores tempore
      voluptatem? Rem odit quas tempore id autem, harum quisquam veniam possimus
      quidem expedita. Quam, debitis eum illo saepe numquam odit quae,
      voluptatem ullam possimus inventore laudantium sapiente delectus culpa
      dolores ab vitae commodi molestiae quidem natus est minima distinctio
      voluptate quisquam ratione? Sed? Distinctio unde culpa est eveniet
      praesentium repellat repellendus, natus aliquam sequi. Quidem, dolor magni
      ut corporis sint cum neque amet. Natus voluptates numquam, illum iusto
      obcaecati voluptatibus ipsam error ad. Quibusdam quod repudiandae
      accusamus, optio vero, architecto alias temporibus, id ad culpa eum vel
      aperiam doloribus? Laborum, ipsa explicabo non dolore nobis veritatis vero
      maiores fuga nisi a, quod esse! Recusandae, maxime laborum sed nulla,
      labore libero, facilis dolorum perspiciatis sunt ea sequi quis totam.
      Tempora, sunt quis? Consequatur at eligendi reprehenderit mollitia impedit
      est autem, qui pariatur. Modi, voluptatum? Ad culpa recusandae nobis
      facilis ea alias nulla consequuntur deleniti dolores dolore, ut
      repudiandae accusantium excepturi hic, exercitationem quos officiis minus
      atque voluptatum asperiores unde consectetur tempore incidunt autem?
      Nobis? Cupiditate reprehenderit alias sapiente, a magni autem similique
      blanditiis hic dolorem, libero eveniet. Dignissimos pariatur, ab
      voluptatibus ex incidunt consequatur assumenda voluptates deserunt porro
      voluptatem eveniet id quibusdam odio blanditiis? Nihil temporibus
      obcaecati ratione. Repellat cum quia, voluptas nam beatae sed deleniti
      tenetur officiis sit corrupti labore magnam natus. Unde in maxime beatae
      incidunt molestias, inventore commodi ut dignissimos temporibus. Iusto
      consequuntur delectus corporis maiores ex eos impedit nemo ipsum laborum
      dicta? Veritatis omnis voluptatem, ipsum veniam fugit ea velit quaerat
      totam sint nam dolore praesentium at nesciunt quos aspernatur. Voluptates
      odio tenetur omnis atque corrupti! Impedit consequuntur pariatur expedita
      tempora quia deserunt aperiam qui repudiandae facere incidunt perspiciatis
      saepe est, ea excepturi repellat ipsum nihil voluptate accusantium?
      Repellat, consequuntur. Culpa vel cum molestias laudantium officiis
      accusantium, quibusdam ex est cupiditate asperiores quae provident
      exercitationem voluptas explicabo dolor velit doloremque? Voluptatum
      incidunt quia molestias officiis dolorum eius provident porro ex. Et
      nostrum veritatis omnis ipsa ullam animi in ad beatae, quas iure soluta
      doloremque hic saepe veniam delectus blanditiis laborum nam ratione,
      dignissimos necessitatibus! Voluptates ea distinctio quo accusamus
      exercitationem. Aperiam, id voluptas rerum odio natus minima sunt expedita
      nemo odit magnam neque magni voluptatum facere, sint inventore, quas fugit
      maiores provident! Tempora similique, ipsa impedit doloribus architecto
      labore veniam. Excepturi rem unde culpa. Enim rem aspernatur sequi quasi,
      minima autem, accusamus hic ea soluta eaque, tempora eveniet ipsa placeat
      minus harum aliquid dolor temporibus? Voluptatem quas cumque quisquam
      alias? Consectetur, quos, nisi delectus magnam, quis accusantium minima
      incidunt atque dignissimos perspiciatis assumenda asperiores porro! Alias
      ad omnis vitae labore eos blanditiis pariatur dolores, incidunt, nemo modi
      soluta voluptatum aut. Nisi veritatis aut dolores earum excepturi nobis
      numquam error totam cupiditate velit at, accusamus asperiores dolorem.
      Sint, ipsa ex eaque eos maxime veritatis sequi sunt, in doloribus sit
      facilis asperiores. Minima ab eaque perspiciatis, laborum debitis quaerat
      saepe dignissimos illo deleniti aliquam velit est qui voluptas omnis unde
      sed cupiditate repellendus. Temporibus ipsa omnis amet, fugit ab
      assumenda? Iusto, animi! Totam voluptates accusantium ducimus accusamus
      laboriosam eos sit laudantium veniam! Distinctio dolorem reiciendis quo
      repellat animi obcaecati, commodi rerum possimus veritatis architecto eum,
      doloremque voluptate? Sed rem atque nulla quidem! Dolorum nobis sed
      nostrum quos doloribus. Magni perspiciatis saepe tempore vero nobis
      voluptates nam voluptas inventore quidem iure esse iste a incidunt,
      delectus repudiandae vel eum et rem quaerat modi. Ut repudiandae at
      tempore dignissimos mollitia cumque repellat, sapiente sequi, veritatis
      aperiam, ex quis modi ab facilis nihil! Error accusamus exercitationem
      dolor iusto nemo cum deleniti obcaecati similique soluta dolore.
      Asperiores reprehenderit fugiat quisquam, repellendus esse rerum!
      Consectetur voluptatem, nesciunt vero rem corrupti omnis, eveniet quae sit
      soluta enim inventore aliquid cumque pariatur laudantium consequatur nemo
      sed quam debitis quia. Veritatis, ab fugit beatae dolorem, consequatur
      ipsum esse repudiandae delectus aliquam est adipisci expedita obcaecati
      nisi amet porro molestiae architecto ipsam sit excepturi sapiente maiores
      dicta quisquam! Ad, aspernatur fugiat. Corporis atque hic autem soluta.
      Repellendus quas nesciunt iure eos vero rerum laudantium, laborum fugit
      perferendis nostrum delectus, dicta a illum explicabo iste maxime ducimus.
      Hic, magni! Asperiores, nulla quidem? Minus commodi quis deleniti magni
      perferendis! Ducimus non earum qui aspernatur beatae vel maxime impedit
      accusantium eius harum. Unde repellendus est reprehenderit impedit aliquam
      perspiciatis numquam, optio inventore id aliquid. Dolore, et molestiae
      magnam exercitationem a cum, error voluptatibus distinctio praesentium
      laborum impedit harum odio? Exercitationem dolore reprehenderit tempora
      eaque, ducimus doloribus vitae aut voluptates assumenda unde aliquam,
      consequatur nihil. Quae ipsam dolores distinctio, ullam quia quidem nobis
      consequatur nostrum velit delectus fuga dicta iure praesentium voluptatum
      tempore pariatur hic deleniti ex odit necessitatibus aperiam nemo porro
      architecto cupiditate. Error? Enim voluptatibus iusto quo magni officia
      labore obcaecati, necessitatibus laborum, dolores earum assumenda
      consectetur nam corporis pariatur reiciendis velit ea vero, numquam
      soluta? Excepturi sit ipsum minus error fugiat natus. Adipisci, quam
      reprehenderit, ratione a quasi nulla error nobis quos quaerat impedit ipsa
      enim accusantium excepturi deleniti natus odit veritatis officia
      voluptates doloremque architecto, exercitationem sint ullam? Cum, ea
      autem. Ut possimus molestias voluptatibus praesentium ipsam alias,
      distinctio corporis a saepe minima officia error non sint perspiciatis
      vero! Doloremque quod cumque eius alias animi autem! Molestias quas quis a
      saepe. Sint consectetur est ut enim id, explicabo sequi cumque possimus,
      eveniet consequuntur harum corrupti reiciendis hic. Repellendus fugit
      repellat inventore incidunt consectetur quis voluptates unde, quos
      similique deserunt, saepe perferendis. Perferendis, consequuntur,
      excepturi nam maxime, voluptatum sed ullam harum possimus accusantium quia
      nisi eius. Harum sunt eaque accusantium voluptate quia, reiciendis officia
      quaerat facere? Quod esse eaque deleniti laboriosam aliquid. Impedit, esse
      exercitationem voluptatum, ab commodi, enim labore architecto dolorem
      necessitatibus consequatur similique nostrum explicabo quidem ipsa quod
      aliquam! Impedit error eius sunt expedita, cupiditate quod atque magnam
      officia neque. Architecto tenetur provident molestiae tempore veniam
      accusantium soluta velit ad, suscipit culpa at quibusdam natus
      perspiciatis explicabo dolor. Aliquid nesciunt eveniet rem perspiciatis et
      velit quam, non voluptas laboriosam architecto! Similique consequatur
      voluptatem totam iure quae reprehenderit quasi nam sint. Fugiat
      exercitationem consequatur, est iste, deleniti neque voluptas aperiam nisi
      maiores aut dolorem voluptatum quidem quam labore placeat molestiae fuga.
      Molestias necessitatibus minima explicabo aperiam cupiditate ducimus,
      alias iure repudiandae dolorum officiis sint atque temporibus officia nam
      corporis, odio quasi a, nisi quidem quisquam libero! Harum dolorum
      repudiandae perspiciatis obcaecati? At id amet perspiciatis quod earum
      itaque nemo dolores et consectetur iste, aperiam in ea alias obcaecati
      dignissimos maiores. Veritatis incidunt temporibus iure modi nemo fuga
      beatae. Maxime, tenetur distinctio? Consectetur tempore dolorem fugiat
      similique itaque natus laboriosam distinctio totam repellendus, quod
      voluptas esse vero exercitationem blanditiis, est eum ipsum sunt unde,
      nesciunt corporis corrupti. Cum molestias architecto molestiae tempore?
      Sapiente quasi voluptatibus est nam optio officia ipsum explicabo quia
      velit perferendis itaque facere molestias sequi molestiae sunt possimus
      impedit, voluptatem recusandae quisquam? Amet exercitationem, aspernatur
      sequi officia laudantium eius? Molestias, ex? Sapiente non explicabo,
      ullam esse doloremque consectetur minima molestiae. Aliquam dicta eius
      aperiam aliquid reiciendis dolor impedit, nostrum itaque neque. Fugit,
      deleniti ducimus? Temporibus at quae doloremque deleniti. Suscipit enim
      corporis eveniet quasi aspernatur sequi cum totam et, quo laborum officia
      expedita. Illum, totam deserunt! Officiis laudantium perspiciatis, quam
      culpa deleniti repudiandae numquam mollitia. Officia corrupti ipsa
      perferendis! Corrupti possimus aliquid optio provident similique et
      quaerat laborum laudantium, quis debitis itaque tempora error, voluptates
      culpa commodi alias maiores repudiandae, esse facere rerum magni? Totam
      quibusdam facilis tenetur voluptas. Harum, alias explicabo voluptates
      inventore repudiandae aut consequatur sit dicta eum quis reiciendis id
      assumenda tempora repellendus quod odit earum facere quasi natus neque
      vero fugit quaerat debitis? Qui, nisi! Ducimus voluptates perspiciatis
      nesciunt eaque, quod fugiat dignissimos consequatur distinctio autem fugit
      eius nemo consectetur aliquid asperiores atque minus nostrum inventore,
      animi pariatur fuga sit aperiam! Libero minus ipsa cupiditate. Doloremque,
      enim sit doloribus dolor recusandae ipsum nisi autem ducimus optio.
      Repudiandae, nihil assumenda minima rerum, voluptatum adipisci dolores
      provident cum fugit ab suscipit fuga fugiat perspiciatis, sed doloremque
      velit! Voluptate at fugiat repellat quo deserunt perferendis temporibus
      rerum, id obcaecati, qui dolor necessitatibus voluptatem sequi fuga.
      Incidunt sapiente impedit deserunt at quidem quia magnam aliquid quod
      nostrum. Obcaecati, voluptatem. Eos delectus, quisquam enim veritatis quo
      consequatur beatae eligendi laudantium pariatur tenetur nesciunt tempore
      nulla doloremque dicta, quidem cumque? Recusandae expedita provident
      dignissimos reprehenderit, fuga fugit quidem? Numquam, accusantium et?
      Repellendus, nostrum non magni unde dolores esse mollitia delectus.
      Aliquam, voluptatibus. Dolore velit similique ullam a libero perspiciatis
      deleniti architecto neque perferendis vero. Unde reprehenderit voluptates
      corrupti expedita possimus laborum? Accusantium at beatae fugiat nemo amet
      eaque totam possimus commodi perferendis sit illo soluta dolor aut est
      officiis aliquam praesentium quas, ullam non, nulla eum. Ratione illum
      doloribus repudiandae tempore. Nemo soluta minus hic placeat nam commodi
      nostrum molestiae consequuntur saepe deleniti deserunt, adipisci cum sed
      officia vel et dolor quo alias. Ratione, ducimus. Beatae natus a
      voluptatibus et doloribus. Dignissimos expedita illo, assumenda fuga iure
      optio similique laudantium quasi asperiores ut veritatis, voluptate
      molestiae veniam nobis vitae? Libero reiciendis ducimus et molestiae
      perspiciatis rerum perferendis! Ipsa delectus necessitatibus eligendi!
      Earum inventore porro ipsum libero error, dicta quibusdam hic itaque
      consequatur dignissimos cum facere quae blanditiis, atque, neque repellat
      animi delectus distinctio aliquam? Quaerat assumenda necessitatibus sunt
      quod reiciendis esse. Voluptas suscipit at quae minus, veritatis delectus
      deleniti, enim illo dolore, quidem mollitia soluta molestiae commodi modi
      distinctio alias labore. Ipsum, rem sint. Inventore quia ullam enim natus
      repellendus consequatur? Officia nemo doloremque quos ratione. Vitae
      corporis aliquid quasi incidunt aperiam unde, earum ratione aut natus iure
      saepe distinctio, facilis recusandae veniam! Deserunt est corrupti soluta
      tenetur nesciunt veritatis voluptas. Reprehenderit sapiente quibusdam, ad
      optio cum corporis fuga quo eveniet perferendis eius sit nobis, enim
      expedita, fugit labore excepturi adipisci et velit dolorem debitis
      necessitatibus quae consequuntur perspiciatis? Sed, facere? Distinctio
      iusto delectus harum odio repellat animi doloremque adipisci facere
      consectetur vero perspiciatis quaerat vitae, voluptates ex eligendi nisi
      a. Quos earum excepturi similique molestiae. Est, asperiores odit?
      Perferendis, vero! Voluptatem voluptates facilis dolores exercitationem.
      Consectetur ratione sapiente exercitationem blanditiis earum id itaque
      quidem ab aspernatur numquam velit illo tenetur fuga accusantium corporis
      non, quod delectus similique dolorem. Animi, amet. Delectus dolorem,
      laboriosam impedit illum rem voluptas a inventore dolor magni perspiciatis
      blanditiis molestias, quia illo culpa dignissimos sit, cupiditate
      explicabo sint facere? Neque eos quidem perferendis sint expedita quis?
    </p>

    <!--   <button id="demo">The time is?</button> -->

    <script>
      /* const time = (document.getElementById("demo").innerHTML = Date()); */

      //Form pop up function
      const showPopupBtn = document.querySelector(".signin");
      const hidePopupBtn = document.querySelector(".form-popup .close-button");

      showPopupBtn.addEventListener("click", () => {
        document.body.classList.toggle("show-popup");
        document.querySelector(".signup-form").classList.add("d-none");
        document.querySelector(".login").classList.remove("d-none");
      });

      hidePopupBtn.addEventListener("click", () => showPopupBtn.click());

      //Direct to signup page if user have no account

      const signupBtn = document.querySelector(".login-signup");
      signupBtn.addEventListener("click", () => {
        document.querySelector(".signup-form").classList.remove("d-none");
        document.querySelector(".login").classList.add("d-none");
      });

      //Back to Login page if already has
      const backToLogin = document.querySelector(".already-button");
      const hidesingup = document.querySelector(".close-singup");
      backToLogin.addEventListener("click", () => {
        document.querySelector(".signup-form").classList.add("d-none");
        document.querySelector(".login").classList.remove("d-none");
      });

      hidesingup.addEventListener("click", () => {
        document.querySelector(".signup-form").style.display = "none";
        document.querySelector(".blur-background").style.opacity = "0";
        /*   document.querySelector(".blur-background").style.display = "none"; */
      });

      //hide signup form
      /* const hidesingup = document.querySelector(".close-singup"); */

      //Password Visible function
      const passwordVisibile = () => {
        const x = document.getElementById("password");
        const visible = document.getElementById("icon1");
        const hide = document.getElementById("icon2");

        if (x.type === "password") {
          x.type = "text";
          visible.style.display = "block";
          hide.style.display = "none";
        } else {
          x.type = "password";
          visible.style.display = "none";
          hide.style.display = "block";
        }
      };

      const signupPasswordVisible = () => {
        const y = document.querySelector(".pass-signup-container #password ");
        const visible1 = document.getElementById("icon3");
        const hide1 = document.getElementById("icon4");

        if (y.type === "password") {
          y.type = "text";
          visible1.style.display = "block";
          hide1.style.display = "none";
        } else {
          y.type = "password";
          visible1.style.display = "none";
          hide1.style.display = "block";
        }
      };

      const signupPopUp = document.querySelector(".signup");
      const closeSigup = document.querySelector(".close-singup");
      const loginPopUp = document.querySelector(".already-account");

      signupPopUp.addEventListener("click", () => {
        document.querySelector(".blur-background").style.display = "block";
        document.querySelector(".signup-form").style.display = "block";
      });

      closeSigup.addEventListener("click", () => {
        document.querySelector(".signup-form").style.display = "none";
      });

      loginPopUp.addEventListener("click", () => {
        document.querySelector(".login").classList.remove("e-none");
        document.querySelector(".signup-form").classList.add("e-none");
      });
    </script>
  </body>
</html>
