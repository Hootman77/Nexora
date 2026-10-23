{
  nixConfig = {
    extra-substituters = [ "https://nix-community.cachix.org" ];

    extra-trusted-public-keys = [
      "nix-community.cachix.org-1:mB9FSh9qf2dCimDSUo8Zy7bkq5CX+/rkCWyvRCYg3Fs="
    ];

    extra-experimental-features = [
      "flakes"
      "nix-command"
    ];
  };

  inputs = {
    nixpkgs = {
      type = "indirect";
      id = "nixpkgs";
    };

    flake-parts = {
      type = "indirect";
      id = "flake-parts";
      inputs.nixpkgs-lib.follows = "nixpkgs";
    };

    process-compose-flake = {
      type = "github";
      owner = "platonic-systems";
      repo = "process-compose-flake";
      flake = false;
    };

    services-flake = {
      type = "github";
      owner = "juspay";
      repo = "services-flake";
      flake = false;
    };
  };

  outputs =
    { flake-parts, ... }@inputs:
    let
      inherit (flake-parts.lib) mkFlake;
    in
    mkFlake { inherit inputs; } (
      { inputs, ... }: {
        imports = [ (inputs.process-compose-flake.sourceInfo.outPath + "/nix/flake-module.nix") ];

        systems = [ "x86_64-linux" ];
        debug = true;

        perSystem =
          { pkgs, ... }:
          let
            inherit (pkgs) mkShell;
            dbName = "nominationsv1";
          in
          {
            process-compose.nexora-dev = {
              imports = [ (inputs.services-flake.sourceInfo.outPath + "/nix/process-compose/default.nix") ];

              services.mysql.nexora = {
                enable = true;

                initialDatabases = [
                  {
                    name = dbName;
                    schema = ./test_schemas;
                  }
                ];
              };
            };

            devShells.default = mkShell {
              NIXPKGS_ALLOW_UNFREE = 1;

              packages = with pkgs; [
                intelephense
                php
              ];
            };
          };
      }
    );
}
