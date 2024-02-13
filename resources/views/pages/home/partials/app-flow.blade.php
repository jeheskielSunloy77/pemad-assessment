  <section id="app-flow" class="container mx-auto sm:px-6 lg:px-8 space-y-6 md:space-y-12 py-10" x-data="{ openTab: null }">
      <header class="space-y-4 max-w-2xl mx-auto">
          <h1 class="text-3xl font-bold text-center underline underline-offset-8 decoration-pink-500">Application Flow
          </h1>
          <p class="text-center text-gray-600 dark:text-gray-300">
              A diagram of the <strong>database schema</strong>, showing the relationships between the tables. The
              diagram is written in
              <i>DMBL</i> and can be found in the <a
                  href="https://dbdiagram.io/d/pemad-assessment-65cce913ac844320ae252d4b" class="text-pink-500"
                  target="_blank" rel="noopener noreferrer">here</a>.
          </p>
      </header>
      </h1>
      <img src={{ asset('/assets/db-diagram-' . $theme . '.svg') }} class="mx-auto " />
  </section>
