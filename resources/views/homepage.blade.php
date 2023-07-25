<style>
    .outlined-text {
        text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;
    }
</style>
<x-app-layout>

    <div class="relative">
        <img src="{{ asset('images/kapsalon.png') }}" alt="Background Image" class="object-cover w-full h-1/2">
        <div class="absolute inset-0 flex flex-col justify-top mt-20 items-center px-6 sm:px-10 md:px-20 lg:px-40">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-[#3B608C] tracking-tight leading-tight 
            outlined-text text-stroke-white outlined-text">
                Kapsalon "Je haar zit goed"</h1>
        </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-8">
  <div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto bg-white rounded-md shadow-md overflow-hidden p-8">
      <h2 class="text-3xl font-bold mb-4 text-black">Visie</h2>
      <div class="py-4 px-6">
        <div class="max-w-2xl mx-auto">
          <p>Bij Kapsalon "Je haar zit goed" streven we ernaar om vrouwen in de leeftijdsgroep van 15 tot 45 jaar te voorzien van trendy kapsels die hun persoonlijkheid en stijl weerspiegelen. Onze visie is gebaseerd op het begrip dat een goed kapsel het zelfvertrouwen van een vrouw kan vergroten en haar in staat kan stellen om zichzelf op een unieke en modieuze manier uit te drukken.</p> <br>

<p>We creëren niet alleen kapsels, maar ook geweldige ervaringen voor elke klant. Ons professionele en vriendelijke team begrijpt de wensen en behoeften van elke klant en vertaalt deze naar een perfect passend kapsel. We blijven op de hoogte van de laatste trends en experimenteren met innovatieve stijlen om onze klanten altijd te voorzien van de meest trendy looks.</p> <br>

<p>Daarnaast hechten we waarde aan duurzaamheid en milieubewustzijn. We maken gebruik van milieuvriendelijke producten en streven naar minimale afval- en energieconsumptie. We willen een positieve bijdrage leveren aan onze gemeenschap en het milieu.</p> <br>

<p>Bij Kapsalon "Je haar zit goed" willen we vrouwen inspireren, hun eigen stijl omarmen en hen vol vertrouwen onze kapsalon laten verlaten, wetende dat hun haar er geweldig uitziet. We streven ernaar om de go-to bestemming te zijn voor trendy kapsels, en om vrouwen te helpen zichzelf te laten stralen.</p> <br>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="container mx-auto px-4 py-8">
  <div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto bg-white rounded-md shadow-md overflow-hidden p-8">
      <h2 class="text-3xl font-bold mb-4 text-black">Behandelingen</h2>
      <div class="py-4 px-6">
        <div class="container mx-auto">
          <div id="treatments-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Product list will be dynamically populated here -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  axios
    .get('/behandelingenLijst')
    .then(function (response) {
      let treatments = response.data;
      let treatmentsContainer = document.getElementById('treatments-container');

      treatments.forEach(function (treatment) {
        var card = document.createElement('div');
        card.classList.add('bg-white', 'rounded-md', 'shadow-md', 'p-4');

        var titleAndPriceContainer = document.createElement('div');
        titleAndPriceContainer.classList.add('flex', 'justify-between', 'items-center');

        var title = document.createElement('h2');
        title.classList.add('text-2xl', 'font-bold', 'mb-2', 'text-black');
        title.textContent = treatment.name;

        var price = document.createElement('p');
        price.classList.add('text-gray-700');
        price.textContent = '€' + treatment.price;

        titleAndPriceContainer.appendChild(title);
        titleAndPriceContainer.appendChild(price);

        card.appendChild(titleAndPriceContainer);
        treatmentsContainer.appendChild(card);
      });
    })
    .catch(function (error) {
      console.log(error);
    });
</script>






</x-app-layout>
